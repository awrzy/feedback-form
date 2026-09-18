class FeedbackApp {
    constructor() {
        this.form = document.getElementById('feedback-form');
        this.errorsBox = document.getElementById('form-errors');
        this.messagesList = document.getElementById('messages');
        this.messageInput = document.getElementById('message');
        this.charCounter = document.getElementById('char-counter');

        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        this.messageInput.addEventListener('input', () => this.updateCharCounter());

        this.loadMessages();
    }

    async handleSubmit(event) {
        event.preventDefault();
        this.errorsBox.textContent = '';

        const formData = new FormData(this.form);

        try {
            const response = await fetch('/index.php?action=store', {
                method: 'POST',
                body: formData,
            });

            const result = await response.json();

            if (!result.success) {
                this.errorsBox.textContent = result.errors.join(', ');
                return;
            }

            this.form.reset();
            this.updateCharCounter();
            await this.loadMessages();
        } catch (error) {
            this.errorsBox.textContent = 'Ошибка отправки. Попробуйте позже.';
            console.error(error);
        }
    }

    async loadMessages() {
        try {
            const response = await fetch('/index.php?action=list');
            const messages = await response.json();

            this.messagesList.innerHTML = messages
                .map((msg) => `
                    <li>
                        <strong>${msg.full_name}</strong> — <em>${msg.email}</em><br>
                        <small>${msg.created_at}</small>
                        <p>${msg.message}</p>
                    </li>
                `)
                .join('');
        } catch (error) {
            console.error('Ошибка загрузки сообщений:', error);
        }
    }

    updateCharCounter() {
        const currentLength = this.messageInput.value.length;
        const maxLength = this.messageInput.maxLength;
        this.charCounter.textContent = `${currentLength} / ${maxLength}`;
    }
}

document.addEventListener('DOMContentLoaded', () => new FeedbackApp());