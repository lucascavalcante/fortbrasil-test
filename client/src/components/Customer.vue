<template>
    <div class="hello">
    </div>
</template>

<script>
    import {APIService} from '../APIService';
    const API_URL = 'http://localhost:8000';
    const apiService = new APIService();

    export default {
        name: 'Customer',
        components: {
        },
        data() {
            return {
                customers: []
            };

        },
        methods: {
            getCustomers(){
                apiService.getCustomers().then((data) => {
                    console.log(data);
                    //this.customers = data.data;
                });
            },
        },
        mounted() {
            this.getCustomers();
        },
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    h1, h2 {
        font-weight: normal;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        display: inline-block;
        margin: 0 10px;
    }
    a {
        color: #42b983;
    }
</style>
