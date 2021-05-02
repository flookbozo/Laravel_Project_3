<template>
    <div>
        <navbar :app="this" class ="mb-2"></navbar>
            <spinner v-if="loading"></spinner>
                <div v-else-if="initiated">
                    <router-view :app="this"/>
                </div>
    </div>
</template>

<script>
import Navbar from './components/Navbar';
export default {
    name: 'app',
    components: {
        Navbar
    },
    data() {
        return {
            user: null,
            hospital: null,
            loading: false,
            initiated: false,
            req: axios.create({
                baseUrl: BASE_URL
            })
        }
    },
    mounted(){
        if(localStorage.getItem('User') == "User") {
            this.initUser();
        }
        else{
            this.initHospital();
        }
    },
    methods: {
        initUser()
        {
            this.loading = true;

            this.req.get('auth/init').then(response => {
                this.user = response.data.user;
                this.loading = false;
                this.initiated = true;
            })
        },
        initHospital()
        {
            this.loading = true;

            this.req.get('auth/hospital/init').then(response => {
                this.user = response.data.hospital;
                this.loading = false;
                this.initiated = true;
            })
        }
    }
};
</script>

<style>
</style>