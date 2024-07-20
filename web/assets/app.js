function toDoList() {
    return {
        newTodo: "",
        todos: [],
        filter: "all",
        addToDo() {
            if (this.newTodo.trim() !== "") {
                this.todos.push({
                    todo: this.newTodo,
                    completed: false
                });
                this.newTodo = "";
            }
        },
        toggleToDoCompleted(index) {
            this.todos[index].completed = !this.todos[index].completed;
        },
        deleteToDo(index) {
            this.todos = this.todos.filter((todo, todoIndex) => index !== todoIndex);
        },
        numberOfToDosCompleted() {
            return this.todos.filter(todo => todo.completed).length;
        },
        toDoCount() {
            return this.todos.length;
        },
        isLastToDo(index) {
            return this.todos.length - 1 === index;
        },
        allCompleted() {
            return this.toDoCount() > 0 && this.numberOfToDosCompleted() === this.toDoCount();
        },
        filteredTodos() {
            if (this.filter === "completed") {
                return this.todos.filter(todo => todo.completed);
            } else if (this.filter === "notCompleted") {
                return this.todos.filter(todo => !todo.completed);
            } else {
                return this.todos;
            }
        },
        registerUser() {
            const fullName = this.fullName;
            const email = this.email;
            const password = this.password;
            const confirmPassword = this.confirmPassword;

            fetch('/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    fullName: fullName,
                    email: email,
                    password: password
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        },
        loginUser() {
            const email = this.email;
            const password = this.password;

            // Thực hiện xử lý đăng nhập ở đây, ví dụ:
            // Gửi request đăng nhập đến server và xử lý kết quả
            // Ví dụ sử dụng fetch
            fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Xử lý kết quả từ server
                console.log(data); // In kết quả từ server ra console để debug
                // Thực hiện các hành động phản hồi từ server (chuyển trang, hiển thị thông tin người dùng, ...)
            })
            .catch(error => {
                console.error('Error:', error);
                // Xử lý lỗi nếu có
            });
        }
    };
}