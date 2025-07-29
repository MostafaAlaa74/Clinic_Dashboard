const API_BASE_URL = 'http://127.0.0.1:8000/api';

// Check authentication status
function checkAuthState() {
    const token = localStorage.getItem('token');
    const authButtons = document.querySelector('.auth-buttons');
    
    if (token) {
        // User is logged in, show logout button
        authButtons.innerHTML = '<button id="logoutBtn" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</button>';
        document.getElementById('logoutBtn').addEventListener('click', logout);
    } 
}

// Register function
async function register(formData) {
        const response = await axios.post(`${API_BASE_URL}/register`, formData);
        console.log(response); 
}

// Login function
async function login(formData) {
    try {
        const response = await fetch(`${API_BASE_URL}/login`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });
        const data = await response.json();
        
        if (response.ok && data.Token) {
            localStorage.setItem('token', data.Token);
            window.location.href = 'index.html';
        } else {
            throw new Error(data.messege || 'Login failed');
        }
    } catch (error) {
        alert(error.message);
    }
}

// Logout function
function logout() {
    localStorage.removeItem('token');
    window.location.href = 'login.html';
}

// Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    // Check authentication state on page load
    // checkAuthState();
    const registerForm = document.getElementById('registerForm');
    const loginForm = document.getElementById('loginForm');

    if (registerForm) {
        console.log('Register form found');
        registerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value
            };
            register(formData);
        });
    }

    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = {
                email: document.getElementById('email').value,
                password: document.getElementById('password').value
            };
            login(formData);
        });
    }
});