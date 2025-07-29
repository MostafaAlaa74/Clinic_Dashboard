// API Base URL
const API_BASE_URL = '/api';
const token = localStorage.getItem('token');

// Check authentication status
function checkAuth() {
    const authButtons = document.querySelector('.auth-buttons');
    if (token) {
        authButtons.innerHTML = '<button id="logoutBtn">Logout</button>';
        document.getElementById('logoutBtn').addEventListener('click', logout);
        fetchTasks();
    }
}

// Register function
async function register(userData) {
    try {
        const response = await fetch('http://127.0.0.1:8000/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(userData)
        });
        const data = await response.json();
        console.log('Registration response:', data);
        
        // if (response.ok) {
        //     alert('Registration successful! Please login.');
        //     window.location.href = 'login.html';
        // } else {
        //     console.log('Registration error:', data.message);
        //     throw new Error(data.message || 'Registration failed');
        // }
    } catch (error) {
        console.error('Registration error:', error);
        // alert(error.message);
    }
}

// Login function
async function login(email, password) {
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/login`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email, password })
        });
        const data = await response.json();
        if (data.token) {
            token = data.token;
            localStorage.setItem('token', token);
            checkAuth();
        }
    } catch (error) {
        console.error('Login error:', error);
    }
}

// Logout function
function logout() {
    localStorage.removeItem('token');
    token = null;
    location.reload();
}

// Fetch tasks
async function fetchTasks() {
    try {
        const response = await fetch('http://127.0.0.1:8000/api/tasks', {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });
        const tasks = await response.json();
        displayTasks(tasks);
    } catch (error) {
        console.error('Error fetching tasks:', error);
    }
}

// Display tasks
function displayTasks(tasks) {
    const tasksList = document.getElementById('tasksList');
    tasksList.innerHTML = tasks.map(task => `
        <div class="task-item">
            <div>
                <h3><i class="fas fa-thumbtack"></i> ${task.title}</h3>
                <p><i class="fas fa-align-left"></i> ${task.description}</p>
            </div>
            <span class="priority priority-${task.priority}">
                <i class="fas fa-flag"></i> Priority: ${task.priority}
            </span>
        </div>
    `).join('');
}

// Add new task
async function addTask(taskData) {
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/tasks`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(taskData)
        });
        
        const data = await response.json();
        
        if (response.ok) {
            fetchTasks();
            // Clear the form and show success message
            alert('Task added successfully!');
        } else {
            // Handle validation errors or other error responses
            throw new Error(data.message || 'Failed to add task');
        }
    } catch (error) {
        console.error('Error adding task:', error);
        alert(error.message || 'Failed to add task. Please try again.');
    }
}

// Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    checkAuth();

    // Register form submission
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const userData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value
            };
            register(userData);
        });
    }

    // Task form submission
    const taskForm = document.getElementById('taskForm');
    if (taskForm) {
        taskForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const taskData = {
                title: document.getElementById('taskTitle').value,
                description: document.getElementById('taskDescription').value,
                priority: parseInt(document.getElementById('taskPriority').value)
            };
            addTask(taskData);
            e.target.reset();
        });
    }
});


// Fetch user data
async function fetchUserData() {
    try {
        const response = await fetch('http://127.0.0.1:8000/api/user', {
            headers: {
                'Authorization': `Bearer ${token}`,
                "Content-Type": "application/json",
                "Accept" : "application/json"
            }
        });
        if (!response.ok) {
            throw new Error("فشل في جلب بيانات المستخدم");
        }

        const userData = await response.json();

        if (userData) {
                document.getElementById('userName').textContent = userData.name;
                document.getElementById('userEmail').textContent = userData.email;
        }
    } catch (error) {
        console.error('Error fetching user data:', error);
    }
}

// Display user data
// function displayUserData(userData) {
//     document.getElementById('userName').textContent = userData.name;
//     document.getElementById('userEmail').textContent = userData.email;
// }