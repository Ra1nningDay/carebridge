@extends('layouts.app')

@section('title', 'Chat')

@section('content')
<div class="container py-4 caregiver-chat-container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0 caregiver-chat-card">
                <!-- ส่วนหัว -->
                <div class="card-header caregiver-chat-header d-flex align-items-center">
                    <img src="{{ $conversation->users->where('id', '!=', auth()->id())->first()->avatar_url ?? asset('images/default-avatar.png') }}" 
                        alt="{{ $conversation->users->where('id', '!=', auth()->id())->first()->name ?? 'Unknown User' }}" 
                        class="rounded-circle me-2 chat-header-profile">
                    <h5 class="mb-0">แชทกับ {{ $conversation->users->where('id', '!=', auth()->id())->first()->name }}</h5>
                </div>

                <!-- กล่องข้อความ -->
                <div class="card-body p-0 caregiver-chat-body">
                    <div class="caregiver-chat-box" id="chat-box">
                        <!-- ข้อความจะถูกเพิ่มที่นี่จาก AJAX -->
                    </div>
                </div>

                <!-- ฟอร์มส่งข้อความ -->
                <div class="p-3 caregiver-chat-footer">
                    <form id="chat-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" id="message" name="message" autocomplete="off" class="form-control caregiver-chat-input" placeholder="Type your message..." required>
                            <button type="submit" class="btn caregiver-chat-send-btn">
                                <i class="fa fa-paper-plane px-2 pe-3" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .text-read-status {
    margin-top: 10px;
    font-size: 0.9rem;
    color: #888; 
    padding: 10px;
    background-color: #f4f4f4;
    border-radius: 8px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.text-read-status.read {
    color: #4caf50; /* สีเขียวสำหรับข้อความที่อ่านแล้ว */
}

.text-read-status.unread {
    color: #e6890b; /* สีเหลืองสำหรับข้อความที่ยังไม่อ่าน */
}

/* รูปโปรไฟล์ในส่วนหัว */
.chat-header-profile {
    width: 40px; /* ขนาดความกว้าง */
    height: 40px; /* ขนาดความสูง */
    object-fit: cover; /* ทำให้รูปภาพไม่บิดเบี้ยว */
    border-radius: 50%; /* ทำให้เป็นวงกลม */
    border: 2px solid #ffffff; /* เพิ่มขอบสีขาว */
}

.caregiver-chat-container {
    padding: 20px;
    border-radius: 10px;
}

/* กล่องแชท */
.caregiver-chat-box {
    padding: 20px;
    background-color: #e7e7e7;
    height: 450px;
    overflow-y: auto;
}

/* Bubble ข้อความ */
.caregiver-chat-bubble {
    position: relative; /* ทำให้สามารถใช้ตำแหน่ง absolute */
    max-width: 70%;
    padding: 10px 15px;
    border-radius: 18px;
    font-size: 1rem;
    line-height: 1.5;
    word-wrap: break-word;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.caregiver-chat-bubble-user {
    background-color: #e6890b; /* สีข้อความของผู้ใช้ */
    color: #ffffff;
    text-align: left;
    border-bottom-right-radius: 4px;
    border-bottom-left-radius: 18px;
}

.caregiver-chat-bubble-other {
    background-color: #467061; /* สีข้อความของคู่สนทนา */
    color: #ffffff;
    text-align: left;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 18px;
}

.caregiver-chat-status {
    position: absolute;
    bottom: 5px; /* ให้ตำแหน่งอยู่ด้านล่างสุด */
    left: 50%;
    transform: translateX(-50%); /* จัดให้อยู่กลาง */
    font-size: 0.9rem;
    color: #888;
}

.caregiver-chat-status.read {
    color: #4caf50; /* สีเขียวสำหรับข้อความที่อ่านแล้ว */
}

.caregiver-chat-status.unread {
    color: #e6890b; /* สีเหลืองสำหรับข้อความที่ยังไม่อ่าน */
}

.caregiver-chat-header {
    background-color: #003e29;
    color: #ffffff;
    padding: 15px;
    border-bottom: none;
    border-radius: 10px 10px 0 0;
}

.caregiver-chat-input {
    background-color: #e7e7e7;
    color: #333;
    border: none;
    border-radius: 20px 0 0 20px;
    padding: 10px 15px;
}

.caregiver-chat-send-btn {
    background-color: #467061;
    border: none;
    color: #ffffff;
    border-radius: 0 20px 20px 0;
    transition: background-color 0.2s ease-in-out, transform 0.1s;
}

.caregiver-chat-send-btn:hover {
    background-color: #37584e;
    transform: scale(1.05);
}

.caregiver-chat-footer {
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 0 0 10px 10px;
}

@media (max-width: 768px) {
    .caregiver-chat-box {
        height: 300px;
    }

    .caregiver-chat-bubble {
        max-width: 85%;
    }
}

</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const chatBox = document.getElementById('chat-box');
    const chatForm = document.getElementById('chat-form');
    const messageInput = document.getElementById('message');
    const authUserId = {{ auth()->id() }};
    const conversationId = {{ $conversation->id }};
    const readStatusElement = document.getElementById('read-status');

    // ฟังก์ชันดึงข้อความ
    const fetchMessages = () => {
        fetch(`/chat/${conversationId}/messages`)
            .then(response => response.json())
            .then(messages => {
                chatBox.innerHTML = ''; // ลบข้อความเก่า
                let latestMessage = null;

                messages.forEach(message => {
                    const isMine = message.user_id === authUserId;
                    const isRead = message.is_read ? 'read' : 'unread';

                    chatBox.innerHTML += `
                        <div class="d-flex ${isMine ? 'justify-content-end' : 'justify-content-start'} mb-3 align-items-start">
                            <div class="caregiver-chat-bubble ${isMine ? 'caregiver-chat-bubble-user' : 'caregiver-chat-bubble-other'}">
                                <p class="m-0 text-white">${message.content}</p>
                            </div>
                        </div>
                    `;
                });

                chatBox.scrollTop = chatBox.scrollHeight; // เลื่อนลงไปยังข้อความล่าสุด
            });
    };

    // เรียกใช้ฟังก์ชันเพื่อโหลดข้อความเมื่อหน้าโหลด
    fetchMessages();

    // Polling: ดึงข้อความทุกๆ 3 วินาที
    setInterval(fetchMessages, 3000); // ทุกๆ 3 วินาที

    // ส่งข้อความใหม่
    chatForm.addEventListener('submit', e => {
        e.preventDefault();
        const message = messageInput.value;

        if (message.trim() !== '') {
            fetch(`/chat/${conversationId}/send`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ message })
            })
            .then(response => response.json())
            .then(data => {
                messageInput.value = ''; // ล้างข้อความ
                fetchMessages(); // ดึงข้อความใหม่
            });
        }
    });
});
</script>
@endsection
