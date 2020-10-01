<style>

</style>
<template>
    <div class="container">
        <div>
            <router-link to="/items"><button class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9E9E9E" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                </svg>
                Back
                </button>
            </router-link>
        </div>

        <div class="pt-3">
            <span>Item: </span><span>{{details.name}}</span><br>
            <span>Description: </span><span>{{details.description}}</span>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                id: this.$route.params.id,
                details: []
            }
        },
        created(){
            // getItemDetails(){
                let url = window.location.protocol + '//' + window.location.host;
                // console.log(url + '/api/itemDetails/' + this.id)

                axios.get(url + '/api/itemDetails/' + this.id).then((res) => {
                    console.log(res.data.message)
                    this.details = res.data.data
                    localCache.set(url)
                })
            
        }
        
    }
</script>