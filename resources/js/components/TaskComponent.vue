<template> <!--TEMPLATE TASK QUI AFFICHE LES TÂCHES -->
    <div class="container pt-5">
        <div class="form-row">
            <div class="col-row">
                <input type="text" class="form-control" @keyup="searchTask" v-model="search" placeholder="Recherchez une tâche..">
            </div> 
        </div>
        <add-task @task-added="refresh"></add-task>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center" v-for="task in tasks.data" :key="task.id">
                    <a href="#">{{ task.name }}</a>
                    <div>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#editModal" @click="getTask(task.id)">Modifier</button>
                        <button type="button" class="btn btn-danger" @click="deleteTask(task.id)" >Supprimer</button>
                    </div>
                </li>
                <edit-task v-bind:taskToEdit="taskToEdit" @task-updated="refresh"></edit-task>
            </ul>
            <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
    </div>
</template>

<script>
    export default 
    {

        data() {
           return {
               tasks: {},
               taskToEdit: '',
               search: ''
           }
        },

        created() {
            axios.get('https://lepetitbloc.dev/tasksList')
            .then(response => this.tasks = response.data)
            .catch(error => console.log(error));
        },


        methods:
        {
            getResults(page = 1)
            {
                axios.get('https://lepetitbloc.dev/tasksList?page=' + page)
                    .then(response => {
                        this.tasks = response.data;
                });
            },

            deleteTask(id)
            {
                axios.delete('https://lepetitbloc.dev/tasks/' + id)
                .then(response => this.tasks = response.data)
                .catch(error => console.log(error));
            },

            refresh(tasks)
            {
                this.tasks = tasks.data
            },

            getTask(id)
            {
                axios.get('https://lepetitbloc.dev/tasks/edit/' + id)
                    .then(response => this.taskToEdit = response.data)
                    .catch(error => console.log(error));
            },

            searchTask()
            {
                if(this.search.length > 3)
                {
                    axios.get('https://lepetitbloc.dev/tasksList/' + this.search)
                    .then(response => this.tasks = response.data)
                    .catch(error => console.log(error));
                }
                else
                {
                    axios.get('https://lepetitbloc.dev/tasksList/')
                    .then(response => this.tasks = response.data)
                    .catch(error => console.log(error));
                }
            }
        },

    }
</script>
