<template>
    <div class="card">
        <div class="card-header">User Info</div>
        <div class="card-body">
            <div v-model="user">
                <label for="user_name">
                    ユーザー名:
                </label>
                <span id="user_name">
                    {{ user.name }}
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    name: 'nothing'
                }
            }
        },
        mounted() {
            console.log('Component mounted.');
            let api_token = 'peN1wDalDQmLEw10I3eZdmhxE5GA4fiif1YzUtPkz1EdrONuJU9YDv8wQl61';

            axios.get('/api/v1/user', {
                headers: {
                    Authorization: `Bearer ${api_token}`
                }
            }).then(response => {
                console.log(response.data);
                this.user = response.data;
            }).catch(error => {
                console.log(error);
            });
        },
    }
</script>
