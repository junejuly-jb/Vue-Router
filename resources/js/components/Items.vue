<template>
    <div class="container">
        <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="7"></textarea>
                        </div>
                    </form>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>
        <div class="py-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Item</button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
        <tbody>
        
        </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                form: new Form({
                    name : '',
                    description : ''
                })
            }
        },
        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>
