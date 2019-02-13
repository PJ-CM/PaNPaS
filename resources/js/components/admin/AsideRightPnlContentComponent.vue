<template>
                <div class="p-3">
                    <h5>Conectados...</h5>
                    <div class="row m-1 pnl-online-item" v-for="(elem_oLL, index) in elems_online_list" :key="index">
                        <router-link :to="{ name: 'user_profile', params: {id: elem_oLL.id} }" :title="'Ver perfil de ' + elem_oLL.name + ' ' + elem_oLL.lastname" class="col-12">
                            <div class="row">
                                <div class="col-10">
                                    <img :src="elem_oLL.avatar" alt="Avatar del usuario" class="img-size-50 mr-2 img-circle" style="border: green 2px solid;"> {{ '@' + elem_oLL.username }}
                                </div>
                                <div class="col-2">
                                    <i title="Online" class="fas fa-circle text-success"></i>
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
</template>

<script>
    export default {
        mounted() {//o created()
            console.log('Component mounted.')

            //para cargar el listado de registros no leidos al llegar al componente
            //this.getElemsTotNoLeidos();

            //para cargar el listado de usuarios conectados al llegar al componente
            //this.getElemsList();

            //Recibiendo notificación con lista de usuarios conectados actualmente
            BusEvent.$on('notifRecargaOnLineListEvent', (onLineList) => {
                this.elems_online_list = onLineList;
            });
        },

        //datos devueltos por el componente:
        data() {
            return {
                elems_online_list: [],
            }
        },

        methods: {
            //
        }
    }
</script>
