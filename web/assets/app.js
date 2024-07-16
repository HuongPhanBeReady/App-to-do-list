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
        }
    };
}
