<template>
 <div>
     <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="EditModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Task</h5>
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
                            <input name="name" type="text" placeholder="Enter the task name..." class="form-control" v-model="tasktoEdit.name"> 
                       </div>

                   </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" @click="Updatetask" data-dismiss="modal">Update</button>
            </div>
            
            
            </div>
        </div>
        </div>
 </div>
</template>
<script>
export default {
    props: ['tasktoEdit'],
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
        Updatetask() {
            if(!this.tasktoEdit.name)
            {
                this.errors.push('the name is required')
                return;
            }
            this.req.put('/updateTask/' + this.tasktoEdit.id, { name: this.tasktoEdit.name })
			.then(response => {
				 this.$emit('task-updated', response)
                 $("#EditModalCenter").modal('hide');
                  swal({
                    title: "Good job!",
                    text: "Task was updated",
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