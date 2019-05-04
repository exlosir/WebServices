<template>
    <div class="tab-pane fade pl-3" id="nav-add-role" role="tabpanel" aria-labelledby="nav-add-role-tab">
        <h4 class="lead mt-3">Чтобы получить возможность исполнять заказы, отметье галочкой поле</h4>
        <form action="/" class="form-inline">
            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                <input type="checkbox" class="custom-control-input pl-3" id="customControlInline" value="checkboxValue" v-model="checkbox" @change="update()">
                <label class="custom-control-label" for="customControlInline">{{checkboxVal}}</label>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                checkbox: false,
                checkboxVal: ''
            }
        },
        methods: {
            update: function() {
                if(this.checkbox) {
                    this.addRole();
                    this.checkboxVal = 'Мастер';
                }
                else{
                    this.delRole();
                    this.checkboxVal = 'Не мастер';
                }
            },
            addRole() {
                axios.post('/profile/add-role', {roleName: 'Исполнитель'})
            },
            delRole() {
                axios.post('/profile/del-role', {roleName: 'Исполнитель'})
            },
            getRole() {
                axios.get('/profile/get-role',  {params:{roleName: 'Исполнитель'}}).then((resp)=>{
                    return this.checkbox = resp.data
                })
            }
        },
        mounted() {
            this.getRole()
            if(this.checkbox)
                this.checkboxVal = 'Мастер';
            else
                this.checkboxVal = 'Не мастер';
        }
    }
</script>
