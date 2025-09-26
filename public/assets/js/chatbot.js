// Simple Chatbot JavaScript
class SimpleChatBot {
    constructor() {
        this.isOpen = false;
        this.isTyping = false;
        this.createChatbot();
        this.attachEvents();
        this.showWelcome();
    }

    createChatbot() {
        const chatbotHTML = `
            <div class="chatbot-widget">
                <button class="chatbot-toggle" id="chatbot-toggle">
                    💬
                </button>
                
                <div class="chatbot-container" id="chatbot-container">
                    <div class="chatbot-header">
                        <h4 class="chatbot-title">🤖 Trợ lý Store Computer</h4>
                        <button class="chatbot-close" id="chatbot-close">✕</button>
                    </div>
                    
                    <div class="chatbot-messages" id="chatbot-messages">
                        <!-- Messages will appear here -->
                    </div>
                    
                    <div class="chatbot-input-area">
                        <div class="chatbot-input-group">
                            <input type="text" class="chatbot-input" id="chatbot-input" 
                                   placeholder="Nhập câu hỏi của bạn..." maxlength="300">
                            <button class="chatbot-send" id="chatbot-send">➤</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', chatbotHTML);
    }

    attachEvents() {
        const toggle = document.getElementById('chatbot-toggle');
        const close = document.getElementById('chatbot-close');
        const input = document.getElementById('chatbot-input');
        const send = document.getElementById('chatbot-send');

        toggle.addEventListener('click', () => this.toggleChat());
        close.addEventListener('click', () => this.closeChat());
        send.addEventListener('click', () => this.sendMessage());
        
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.sendMessage();
            }
        });
    }

    toggleChat() {
        const container = document.getElementById('chatbot-container');
        if (this.isOpen) {
            container.classList.remove('show');
            this.isOpen = false;
        } else {
            container.classList.add('show');
            this.isOpen = true;
            document.getElementById('chatbot-input').focus();
        }
    }

    closeChat() {
        document.getElementById('chatbot-container').classList.remove('show');
        this.isOpen = false;
    }

    showWelcome() {
        setTimeout(() => {
            this.addMessage('Xin chào! Tôi là trợ lý AI của Store Computer. Tôi có thể tư vấn về máy tính, laptop và linh kiện. Bạn cần hỗ trợ gì?', 'bot');
        }, 1000);
    }

    async sendMessage() {
        const input = document.getElementById('chatbot-input');
        const send = document.getElementById('chatbot-send');
        const message = input.value.trim();

        if (!message || this.isTyping) return;

        // Add user message
        this.addMessage(message, 'user');
        input.value = '';
        
        // Show typing
        this.setTyping(true);
        send.disabled = true;

        try {
            // Get CSRF token
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            const response = await fetch('/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();
            
            if (data.reply) {
                this.addMessage(data.reply, 'bot');
            } else {
                this.addMessage('Xin lỗi, có lỗi xảy ra. Vui lòng thử lại.', 'bot');
            }
        } catch (error) {
            console.error('Error:', error);
            this.addMessage('Không thể kết nối. Vui lòng kiểm tra internet và thử lại.', 'bot');
        } finally {
            this.setTyping(false);
            send.disabled = false;
            input.focus();
        }
    }

    addMessage(text, sender) {
        const messages = document.getElementById('chatbot-messages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}`;
        messageDiv.innerHTML = `<div class="message-content">${text}</div>`;
        
        messages.appendChild(messageDiv);
        messages.scrollTop = messages.scrollHeight;
    }

    setTyping(typing) {
        this.isTyping = typing;
        const messages = document.getElementById('chatbot-messages');
        
        if (typing) {
            const typingDiv = document.createElement('div');
            typingDiv.className = 'message bot typing-indicator';
            typingDiv.innerHTML = '<div class="message-content typing">Đang soạn tin...</div>';
            typingDiv.id = 'typing-indicator';
            messages.appendChild(typingDiv);
        } else {
            const typingIndicator = document.getElementById('typing-indicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
        }
        
        messages.scrollTop = messages.scrollHeight;
    }
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Add CSRF token if not exists
    if (!document.querySelector('meta[name="csrf-token"]')) {
        const meta = document.createElement('meta');
        meta.name = 'csrf-token';
        meta.content = document.querySelector('input[name="_token"]')?.value || '';
        document.head.appendChild(meta);
    }
    
    // Initialize chatbot
    window.simpleChatBot = new SimpleChatBot();
});
