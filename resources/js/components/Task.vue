<template>
    <div class="container">
         <div class="form-group">
            <input @keyup="search" name="name" type="text" placeholder="Enter the task name..." class="ml-4" v-model="q"> 
         </div>
        <add-task @task-added="refresh"></add-task>
            <ul class="list-group ml-4">
                <li class="list-group-item mb-3" v-for="task in tasks.data" :key="task.id">
                 <a href="">{{ task.name }}</a>
                 <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#EditModalCenter" @click="edittask(task.id)">Edit</button>
                 <button @click="deletetask(task.id)" style="float:right;margin-right:10px"  type="button" class="btn btn-danger btn-sm">Delete</button>
                </li>
            </ul>
            <edit-task :tasktoEdit="this.taskToEdit" @task-updated="refresh"></edit-task>
        <div class="row">
            <pagination :data="tasks" @pagination-change-page="getResults" class="ml-5"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tasks: {},
                req: axios.create({
                baseUrl: BASE_URL
                }),
                taskToEdit: '',
                q:''
            }
        },
        mounted() {
            this.getResults();
        },
        methods: {
            getResults(page = 1) {
			this.req.get('/tasksList?page=' + page)
				.then(response => {
					this.tasks=response.data;
				});
		    },
            refresh() {
                this.getResults();
            },
            edittask(id) {
                this.req.get('/gettask/' + id)
				.then(response => {
                    this.taskToEdit=response.data.task
                    console.log(response.data.task)
				});
		    },
            deletetask(id) {
                swal({
                    title: "Are you sure ?",
                    text: "if you want to delete task cklick Ok to confirm !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        this.req.delete('/deleteTask/' + id)
                        .then(response => {
                            this.refresh();
                        });
                        swal("Task was deleted", {
                        icon: "success",
                        });
                    }
                    });
            },
            search() {
                if(this.q) {
                    this.req.get('/tasksList/' + this.q)
                    .then(response => {
                     this.tasks=response.data
                });
                }
                
            }
        },
    }
</script>
