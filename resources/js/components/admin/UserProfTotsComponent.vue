<template>
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
                :src="objDataResReg.avatar"
                alt="Avatar del usuario">
            <span v-if="objDataResReg.isOnline" title="Está conectado" class="badge badge-success badge-useronoff-profile">&nbsp;</span>
            <span v-else title="Está desconectado" class="badge badge-useroff badge-useronoff-profile">&nbsp;</span>
        </div>

        <h3 class="profile-username text-center">{{ objDataResReg.name + ' ' + objDataResReg.lastname }}</h3>

        <h5 class="text-muted text-center">@{{ objDataResReg.username }}</h5>

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <strong>Recetas</strong> <a class="float-right">{{ objDataResReg.user_recetas_tot }}</a>
            </li>
            <li class="list-group-item">
                <strong>Comentarios</strong> <a class="float-right">{{ objDataResReg.user_comentarios_tot }}</a>
            </li>
            <li id="top-msgs-contact" class="list-group-item">
                <strong>Mens. Contacto</strong> <a class="float-right">{{ objDataResReg.user_mens_contacto_tot }}</a>
            </li>
            <li id="top-followers" class="list-group-item">
                <strong>Seguidores</strong> <a class="float-right">{{ objDataResReg.user_seguidores_tot }}</a>
            </li>
            <li class="list-group-item">
                <strong>Siguiendo a</strong> <a class="float-right">{{ objDataResReg.user_seguidos_tot }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');

            //Recibiendo evento(s) si emitido(s) (en este caso, desde su componente Padre)
            BusEvent.$on('fillProfDataResumEvent', (regID) => {
                this.fillDataResumReg(regID);
            });
        },

        //datos devueltos por el componente:
        data() {
            return {
                //variable para almacenar los datos del registro a almacenar
                objDataResReg: {},
            }
        },

        methods: {

            /**
             * Cargando datos de resumen
            */
            fillDataResumReg(regID) {
                console.log('Cargando datos resumen del registro [' + regID + ']');
                //Haciendo la petición de datos
                let url = '/api/users/prof-data-resum/' + regID;
                axios.get(url)
                .then( response => {       //SI TODO OK
                    console.log(response.data)
                    this.objDataResReg = response.data
                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    console.log(error.response.data.errors);
                });
            },

        },
    }
</script>
