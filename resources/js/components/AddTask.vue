<template>
 <div>
     <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary ml-4 mb-2" data-toggle="modal" data-target="#exampleModalCenter">
        Add new Task
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    
                   <form v-on:submit.prevent="">
                        <div class="alert alert-danger" role="alert" v-if="errors.length">
                            <li v-for="(error,index) in errors" :key="index">{{error}}</li>
                        </div>
                        <div class="form-group">
                           <label for="email">Task Name</label>
                            <input name="name" type="text" placeholder="Enter the task name..." class="form-control" v-model="name"> 
                       </div>

                   </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" @click="taskStore">Save</button>
            </div>
            
            
            </div>
        </div>
        </div>
 </div>
</template>
<script>
export default {
    data() {
        return {
            name:'',
            req: axios.create({
                baseUrl: BASE_URL
            }),
            errors: [],
        }
    },
    methods: {
        taskStore() {
            if(!this.name)
            {
                this.errors.push('the name is required')
                return;
            }
			this.req.post('/addtask', { name: this.name })
			.then(response => {
				 this.$emit('task-added', response)
                 $("#exampleModalCenter").modal('hide');
                 swal({
                    title: "Good job!",
                    text: "Task was added",
                    icon: "success",
                    button: "Ok",
                    });
			}).catch(error => {
                console.log(error)
            });
		}
    }
}
</script>