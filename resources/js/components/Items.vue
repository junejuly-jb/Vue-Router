<template>
    <div class="container">
        <span id="sample"></span>
        <!-- edit modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updateItem">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input v-model="form.name" name="name" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"><has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea v-model="form.description" class="form-control" name="description" cols="30" rows="7" :class="{'is-invalid':form.errors.has('description')}"></textarea><has-error :form="form" field="description"></has-error>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>    
                </div>
                </div>
            </div>
        </div>

        <!-- add modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="createItem">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input v-model="form.name" name="name" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"><has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea v-model="form.description" class="form-control" name="description" cols="30" rows="7" :class="{'is-invalid':form.errors.has('description')}"></textarea><has-error :form="form" field="description"></has-error>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>    
                </div>
                </div>
            </div>
        </div>
        <div class="py-3">
            <button class="btn btn-primary" v-on:click="addItem">Add Item</button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
        <tbody>
            <tr v-for="item in items" :key="item.id">
                <td>{{item.id}}</td>
                <td>{{item.name}}</td>
                <td>{{item.description}}</td>
                <td>
                    <button class="btn" v-on:click="editItem(item)">Edit</button>&nbsp;
                    <button class="btn btn-danger" v-on:click="deleteItem(item.id)">Delete</button>
                    <router-link :to="`/viewDetails/${item.id}`" class="btn btn-secondary">View</router-link>
                </td>
            </tr>
        </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                items: '',
                form: new Form({
                    id: '',
                    name : '',
                    description : ''
                })
            }
        },
        methods: {
            updateItem(){
                this.form.put('api/updateItem/' + this.form.id)
                .then((res) => {
                    $('#editModal').modal('hide')
                    toast.fire({
                        icon: 'success',
                        title: res.data.message
                    })
                    this.getAllItems()
                    // $('#sample').text(form.id)
                }).catch((err) => {
                    toast.fire({
                        icon: 'warning',
                        title: err
                    })
                })
            },
            addItem(){
                $('#addModal').modal('show')
                this.form.reset()
            },
            createItem(){
                this.form.post('api/createItem').then((res) => {
                    $('#addModal').modal('hide')
                    toast.fire({
                        icon: 'success',
                        title: res.data.message
                    })
                    this.getAllItems()
                    this.form.reset()
                })
                
            },
            getAllItems(){
                axios.get('api/allItems').then((res) =>{
                    this.items = res.data.data
                })
            },
            deleteItem(id){
                console.log(id)
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.delete('api/deleteItem/' + id)
                        toast.fire({
                            icon: 'success',
                            title: 'Item remove successfully'
                        })
                        this.getAllItems()
                    }
                    else{
                        swal.close()
                    }
                })   
            },
            editItem(item){
                this.form.reset()
                $('#editModal').modal('show')
                this.form.fill(item)
            }
        },
        mounted() {
            this.getAllItems()
            // console.log('Component mounted.')
        }
    }
</script>
