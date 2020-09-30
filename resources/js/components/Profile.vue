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
        font-size: 22px;
        font-weight: bold;
        color: #1e6262;
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
    .no-pp{
        display: flex;
        align-items: center;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        width: 140px;
        height: 140px;
        border-radius: 50%;
        cursor: pointer;
    }
    .icon-tabler-user-plus{
        margin: 0 auto;
        display: block;
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
                    <div class="text-center rounded-circle" v-if="details.profile != null">
                        <img src="" alt="ProfilePic">
                    </div>
                    <div align="center">
                        <label style="display: block" for="avatar">
                            <img :src="'./images/def.png'" style="-moz-border-radius: 50px;border-radius: 50px;height: 120px" id="imgupload">
                        </label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="avatar" id="avatar" style="display: none">
                        </div>
                    </div>
                    <!-- <div class="no-pp text-center m-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="92" height="92" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9E9E9E" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="9" cy="7" r="4" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 11h6m-3 -3v6" />
                        </svg>
                    </div> -->
                    <div class="text-center pt-3 acct_name text-pop">{{details.name}}</div>
                    <div class="text-center pb-2">
                        <small>Programmer</small>
                    </div>
                    <div class="account_header">Additional Information</div>
                    <hr>
                    <div class="pb-3">
                       <table>
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
                           <tr>
                               <td width="50">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9E9E9E" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <circle cx="12" cy="11" r="3" />
                                    <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                                    </svg>
                                </td>
                               <td class="text-secondary" v-if="details.address != null">{{details.address}}</td>
                               <td class="text-secondary" v-if="details.address == null ">{{form.address}}</td>
                           </tr>
                           
                           <tr>
                               <td>
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-mobile" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9E9E9E" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <rect x="7" y="4" width="10" height="16" rx="1" />
                                        <line x1="11" y1="5" x2="13" y2="5" />
                                        <line x1="12" y1="17" x2="12" y2="17.01" />
                                    </svg>
                                </td>
                               <td class="text-secondary" v-if="details.contact != null">{{details.contact}}</td>
                               <td class="text-secondary" v-if="details.contact == null">{{form.contact}}</td>
                           </tr>
                       </table>
                       <div class="pt-4 text-center">
                           <pre v-if="details.bio != null">" {{details.bio }} "</pre>
                           <pre v-if="details.bio == null">" {{form.bio }} "</pre>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card_profile container">
                    <div class="account_header">Edit Information</div>
                    <hr>
                    <div class="container">
                        <form @submit.prevent="updateUser">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input v-model="form.name" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input v-model="form.address" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('address') }">
                                <has-error :form="form" field="address"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Contact No.</label>
                                <input v-model="form.contact" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('contact') }">
                                <has-error :form="form" field="contact"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Bio</label>
                                <textarea v-model="form.bio" class="form-control" name="" id="" cols="30" rows="5" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                <has-error :form="form" field="bio"></has-error>
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
            },
            updateUser(){
                console.log(this.form)
                this.form.put('api/updateUser').then((res) => {
                    toast.fire({
                        icon: 'success',
                        title: res.data.message
                    })
                    this.getMyInfo()
                }).catch((err) => {
                    console.log(err)
                })
            }
        },
        mounted() {
            this.getMyInfo()
            this.fillForm()
        }
    }
</script>
