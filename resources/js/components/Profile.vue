<style>
    .card_profile{
        /* border: 1px solid gray; */
        border-radius: 5px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        margin-bottom: 10px;
    }
    .account_header{
        font-size: 18px;
        font-weight: bold;
        padding: 20px 0px 0px 10px;
        color:  #1e6262 !important;
    }
    .acct_name{
        font-size: 18px;
    }
    .btnSubmit{
        padding: 10px 25px;
        background: #1e6262;
        border: none;
        border-radius: 5px;
        color: white;
        transition: 0.5s;
        cursor: pointer;
    }
    .btnSubmit:hover{
        background: #b4f1f1;
        color: #1e6262;
        transition: 0.5s;
    }
</style>
<template>
    <div class="container">
        <small>USER INFORMATION</small>
        <hr>
        <div class="row">
            <div class="col-lg-5">
                <div class="container card_profile">
                    <div class="account_header">My Account</div>
                    <hr>
                    <div class="text-center rounded-circle">
                        <img src="" alt="ProfilePic">
                    </div>
                    <div class="text-center pt-3 acct_name">{{details.name}}</div>
                    <div class="text-center pb-2">
                        <small>Programmer</small>
                    </div>
                    <div class="account_header">Additional Information</div>
                    <hr>
                    <div class="pb-5">
                       <table>
                           <tr>
                               <td width="50">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9E9E9E" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <circle cx="12" cy="11" r="3" />
                                    <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                                    </svg>
                                </td>
                               <td class="text-secondary">Cebu City</td>
                           </tr>
                           <tr>
                               <td>
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9E9E9E" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <rect x="3" y="5" width="18" height="14" rx="2" />
                                        <polyline points="3 7 12 13 21 7" />
                                    </svg>
                                </td>
                               <td class="text-secondary">{{details.email}}</td>
                           </tr>
                       </table>
                       <div class="pt-5 text-center">
                           <pre>" Stay foolish. Stay hungry "</pre>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card_profile container">
                    <div class="account_header">Edit Information</div>
                    <hr>
                    <div class="container">
                        <form action="">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input v-model="form.name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Contact No.</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Bio</label>
                                <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button class="btnSubmit" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                details: '',
                form: new Form({
                    name: '',
                    address: '',
                    contact: '',
                    bio: ''
                })
            }
        },
        methods: {
            getMyInfo(){
                axios.get('api/profile').then((res) => {
                    this.details = res.data.data
                })
            },
            fillForm(){
                axios.get('api/profile').then((res) => {
                    let creds = res.data.data
                    this.form.fill(creds)
                })
            }
        },
        mounted() {
            this.getMyInfo()
            this.fillForm()
        }
    }
</script>
