<?php

/** @var yii\web\View $this */

$this->title = 'My To do App';
?>
    <div x-data="toDoList()" class="max-w-2xl mx-auto px-12 py-8 rounded-lg shadow-lg bg-gray-300 h-screen flex flex-col">
        <div class="flex justify-between items-center mb-2">
            <div class="text-lg font-semibold">
                To Dos: <span x-text="toDoCount()"></span> | Completed: <span x-text="numberOfToDosCompleted()"></span>
            </div>
            <div>
                <select x-model="filter" class="px-4 py-2 rounded shadow text-lg">
                    <option value="all">All</option>
                    <option value="completed">Completed</option>
                    <option value="notCompleted">Not Completed</option>
                </select>
            </div>
        </div>
        <div class=" text-lg mb-2">
            <template x-if="allCompleted()">
                <span>Congrats you to finished your list!</span>
            </template>
            <template x-if="!allCompleted()">
                <span><span x-text="toDoCount() - numberOfToDosCompleted()"></span> more to go</span>
            </template>
        </div>
        <div class="bg-white w-full rounded shadow mb-2 flex-grow overflow-auto">
            <template x-for="(todo, index) in filteredTodos()" :key="index">
                <div class="flex items-center py-4 px-4" :class="{ 'border-b border-gray-400': !isLastToDo(index) }">
                    <div class="w-1/12 text-center">
                        <input type="checkbox" @change="toggleToDoCompleted(index)" :checked="todo.completed">
                    </div>
                    <div class="w-10/12">
                        <p x-text="todo.todo" :class="{ 'line-through': todo.completed }"></p>
                    </div>
                    <div class="w-1/12 flex items-center justify-center">
                      <button class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700" @click="deleteToDo(index)">
                          Remove
                      </button>
                  </div>
                  
                </div>
            </template>
        </div>
        <div class="flex justify-end items-center space-x-4">
          <input type="text" x-model="newTodo" placeholder="Add to do item" class="flex-grow px-4 py-2 rounded shadow text-lg" @keydown.enter="addToDo">
          <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow" @click="addToDo">Add</button>
      </div>      
      
    </div>
    <script src="/assets/app.js"></script>
