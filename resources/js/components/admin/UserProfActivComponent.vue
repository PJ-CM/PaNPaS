<template>
    <div class="active tab-pane" id="activity">
        <h4><i class="fas fa-book-open"></i> Últimas Recetas</h4>
        <table><!--  -->
            <tr>
                <td colspan="4">Ultim-Recetas</td>
            </tr>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Publicada</th>
                <th>Descripcion</th>
            </tr>
            <tr v-for="(receta, index) in objActivReg.ultim_recetas" :key="index">
                <!-- <td>{{ objActivReg.ultim_recetas[0] }}</td> -->
                <td>{{ receta.id }}</td>
                <td>{{ receta.titulo }}</td>
                <td>{{ receta.created_at }}</td>
                <td>{{ receta.descripcion }}</td>
            </tr>
        </table>
        <table><!--  -->
            <tr>
                <td colspan="4">Ultim-Comentarios</td>
            </tr>
            <tr>
                <th>ID</th>
                <th>Receta_ID</th>
                <th>Publicado</th>
                <th>Texto</th>
            </tr>
            <tr v-for="(coment, index) in objActivReg.ultim_comentarios" :key="index">
                <!-- <td>{{ objActivReg.ultim_comentarios[0] }}</td> -->
                <td>{{ coment.id }}</td>
                <td>{{ coment.receta_id }}</td>
                <td>{{ coment.created_at }}</td>
                <td>{{ coment.mensaje }}</td>
            </tr>
        </table>
        <table><!--  -->
            <tr>
                <td colspan="4">Ultim-Mens-Contacto</td>
            </tr>
            <tr>
                <th>ID</th>
                <th>Correo</th>
                <th>Mensaje</th>
                <th>Fecha</th>
            </tr>
            <tr v-for="(contact, index) in objActivReg.ultim_mens_contacto" :key="index">
                <!-- <td>{{ objActivReg.ultim_mens_contacto[0] }}</td> -->
                <td>{{ contact.id }}</td>
                <td>{{ contact.correo }}</td>
                <td>{{ contact.mensaje }}</td>
                <td>{{ contact.created_at }}</td>
            </tr>
        </table>
        <div id="accordion-ult-rec">
            <div class="callout callout-info user-block">
                <img class="img-circle img-bordered-sm" src="https://lorempixel.com/640/480/?16609" alt="Foto de la receta">
                <a href="#reg-ult-rec-1" data-toggle="collapse" class="float-right text-sm tit_receta_plus">
                    <i class="fas fa-plus fa-1x" title="Desplegar/Replegar contenido"></i>
                </a>
                <span class="username">
                    <a href="#" class="tit_receta" target="_blank" title="Acceder al detalle">Título de la Receta</a>
                </span>
                <span class="description">Publicada - 7:30 PM today</span>
                <div id="reg-ult-rec-1" class="collapse show" data-parent="#accordion-ult-rec">
                    <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                    </p>
                    <p>
                        <span class="text-sm">
                            <i class="fas fa-star mr-1"></i> Votos (15)
                        </span>
                        <span class="float-right text-sm">
                            <i class="fas fa-comments mr-1"></i> Commentarios (5)
                        </span>
                    </p>
                </div>
            </div>

            <div class="callout callout-info user-block">
                <img class="img-circle img-bordered-sm" src="https://lorempixel.com/640/480/?16609" alt="Foto de la receta">
                <a href="#reg-ult-rec-2" data-toggle="collapse" class="float-right text-sm tit_receta_plus">
                    <i class="fas fa-plus fa-1x" title="Desplegar/Replegar contenido"></i>
                </a>
                <span class="username">
                    <a href="#" class="tit_receta" target="_blank" title="Acceder al detalle">Título de la Receta</a>
                </span>
                <span class="description">Publicada - 7:30 PM today</span>
                <div id="reg-ult-rec-2" class="collapse" data-parent="#accordion-ult-rec">
                    <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                    </p>
                    <p>
                        <span class="text-sm">
                            <i class="fas fa-star mr-1"></i> Votos (15)
                        </span>
                        <span class="float-right text-sm">
                            <i class="fas fa-comments mr-1"></i> Commentarios (5)
                        </span>
                    </p>
                </div>
            </div>

            <div class="callout callout-info user-block">
                <img class="img-circle img-bordered-sm" src="https://lorempixel.com/640/480/?16609" alt="Foto de la receta">
                <a href="#reg-ult-rec-3" data-toggle="collapse" class="float-right text-sm tit_receta_plus">
                    <i class="fas fa-plus fa-1x" title="Desplegar/Replegar contenido"></i>
                </a>
                <span class="username">
                    <a href="#" class="tit_receta" target="_blank" title="Acceder al detalle">Título de la Receta</a>
                </span>
                <span class="description">Publicada - 7:30 PM today</span>
                <div id="reg-ult-rec-3" class="collapse" data-parent="#accordion-ult-rec">
                    <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                    </p>
                    <p>
                        <span class="text-sm">
                            <i class="fas fa-star mr-1"></i> Votos (15)
                        </span>
                        <span class="float-right text-sm">
                            <i class="fas fa-comments mr-1"></i> Commentarios (5)
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <!-- /.Últimas Recetas -->

        <hr class="separador">

        <h4><i class="fas fa-comments"></i> Últimos Comentarios</h4>
        <div id="accordion-ult-com">
            <div class="callout callout-info user-block">
                <img class="img-circle img-bordered-sm" src="https://lorempixel.com/640/480/?16609" alt="Foto de la receta">
                <a href="#reg-ult-com-1" data-toggle="collapse" class="float-right text-sm tit_receta_plus">
                    <i class="fas fa-plus fa-1x" title="Desplegar/Replegar contenido"></i>
                </a>
                <span class="username">
                    en <a href="#" class="tit_receta" target="_blank" title="Acceder al detalle">Título de la Receta</a>
                </span>
                <span class="description">Publicado - 7:30 PM today</span>
                <div id="reg-ult-com-1" class="collapse show" data-parent="#accordion-ult-com">
                    <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                    </p>
                </div>
            </div>

            <div class="callout callout-info user-block">
                <img class="img-circle img-bordered-sm" src="https://lorempixel.com/640/480/?16609" alt="Foto de la receta">
                <a href="#reg-ult-com-2" data-toggle="collapse" class="float-right text-sm tit_receta_plus">
                    <i class="fas fa-plus fa-1x" title="Desplegar/Replegar contenido"></i>
                </a>
                <span class="username">
                    en <a href="#" class="tit_receta" target="_blank" title="Acceder al detalle">Título de la Receta</a>
                </span>
                <span class="description">Publicado - 7:30 PM today</span>
                <div id="reg-ult-com-2" class="collapse" data-parent="#accordion-ult-com">
                    <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                    </p>
                </div>
            </div>

            <div class="callout callout-info user-block">
                <img class="img-circle img-bordered-sm" src="https://lorempixel.com/640/480/?16609" alt="Foto de la receta">
                <a href="#reg-ult-com-3" data-toggle="collapse" class="float-right text-sm tit_receta_plus">
                    <i class="fas fa-plus fa-1x" title="Desplegar/Replegar contenido"></i>
                </a>
                <span class="username">
                    en <a href="#" class="tit_receta" target="_blank" title="Acceder al detalle">Título de la Receta</a>
                </span>
                <span class="description">Publicado - 7:30 PM today</span>
                <div id="reg-ult-com-3" class="collapse" data-parent="#accordion-ult-com">
                    <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                    </p>
                </div>
            </div>
        </div>
        <!-- /.Últimos Comentarios -->

        <hr class="separador">

        <h4><i class="fas fa-envelope"></i> Últimos Mens. Contacto</h4>
        <div id="accordion-ult-con">
            <div class="callout callout-info user-block">
                <img class="img-circle img-bordered-sm" src="https://lorempixel.com/640/480/?16609" alt="Foto de la receta">
                <a href="#reg-ult-con-1" data-toggle="collapse" class="float-right text-sm tit_receta_plus">
                    <i class="fas fa-plus fa-1x" title="Desplegar/Replegar contenido"></i>
                </a>
                <span class="username">
                    <a href="#" class="tit_receta" target="_blank" title="Acceder al detalle">Nombre o Asunto</a>
                </span>
                <span class="description">Publicado - 7:30 PM today</span>
                <div id="reg-ult-con-1" class="collapse show" data-parent="#accordion-ult-con">
                    <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                    </p>
                </div>
            </div>

            <div class="callout callout-info user-block">
                <img class="img-circle img-bordered-sm" src="https://lorempixel.com/640/480/?16609" alt="Foto de la receta">
                <a href="#reg-ult-con-2" data-toggle="collapse" class="float-right text-sm tit_receta_plus">
                    <i class="fas fa-plus fa-1x" title="Desplegar/Replegar contenido"></i>
                </a>
                <span class="username">
                    <a href="#" class="tit_receta" target="_blank" title="Acceder al detalle">Nombre o Asunto</a>
                </span>
                <span class="description">Publicado - 7:30 PM today</span>
                <div id="reg-ult-con-2" class="collapse" data-parent="#accordion-ult-con">
                    <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                    </p>
                </div>
            </div>

            <div class="callout callout-info user-block">
                <img class="img-circle img-bordered-sm" src="https://lorempixel.com/640/480/?16609" alt="Foto de la receta">
                <a href="#reg-ult-con-2" data-toggle="collapse" class="float-right text-sm tit_receta_plus">
                    <i class="fas fa-plus fa-1x" title="Desplegar/Replegar contenido"></i>
                </a>
                <span class="username">
                    <a href="#" class="tit_receta" target="_blank" title="Acceder al detalle">Nombre o Asunto</a>
                </span>
                <span class="description">Publicado - 7:30 PM today</span>
                <div id="reg-ult-con-2" class="collapse" data-parent="#accordion-ult-con">
                    <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                    </p>
                </div>
            </div>
        </div>
        <!-- /.Últimos Mens. Contacto -->
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');

            //Recibiendo evento(s) si emitido(s) (en este caso, desde su componente Padre)
            BusEvent.$on('fillProfActivEvent', (regID) => {
                this.fillActivReg(regID);
            });
        },

        //datos devueltos por el componente:
        data() {
            return {
                //variable para almacenar los datos del registro a almacenar
                objActivReg: {},
            }
        },

        methods: {

            /**
             * Cargando datos de resumen
            */
            fillActivReg(regID) {
                console.log('Cargando datos de actividad del registro [' + regID + ']');
                //Haciendo la petición de datos
                let url = '/api/users/prof-activity/' + regID;
                axios.get(url)
                .then( response => {       //SI TODO OK
                    console.log('Top Últimas recetas:' + response.data);
                    this.objActivReg = response.data;
                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    console.log(error.response.data.errors);
                });


/*

this.objActivReg =  {
    "ultim_recetas": [
        {
            "id": 23,
            "titulo": "titulo22",
            "descripcion": "I shall only look up in spite of all her fancy, that: they never executes nobody, you know. Come on!' So they got their tails in their mouths. So they began solemnly dancing round and swam slowly.",
            "imagen": "https:\/\/lorempixel.com\/640\/480\/?29389",
            "elaboracion": "Paso 1: Alice would not allow without knowing how old it was, and, as the other.' As soon as there was a long argument with the time,' she said.<br \/><br \/>Paso 2: Mock Turtle drew a long breath, and till the Pigeon had finished. 'As if it thought that it might happen any minute, 'and then,' thought Alice, 'to speak to this mouse? Everything.<br \/><br \/>Paso 3: Eaglet. 'I don't know of any one; so, when the Rabbit was no longer.<br \/><br \/>Paso 4: Alice, 'because I'm not particular as to the.<br \/><br \/>",
            "ingredientes": "ingrediente22 395ml",
            "votos": 0,
            "user_id": 25,
            "created_at": "2012-10-18 00:00:00",
            "updated_at": null
        },
        {
            "id": 7,
            "titulo": "titulo6",
            "descripcion": "It sounded an excellent plan, no doubt, and very soon finished off the cake. * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 'What a number of bathing machines in the sea.",
            "imagen": "https:\/\/lorempixel.com\/640\/480\/?12365",
            "elaboracion": "Paso 1: However, on the whole pack of cards!' At this moment the King, and the moon, and memory, and muchness--you know you say things are \"much of a bottle. They all sat down and.<br \/><br \/>Paso 2: CHAPTER IV. The Rabbit started violently, dropped the white kid gloves, and was going to shrink any further: she felt sure it would be quite absurd for.<br \/><br \/>Paso 3: CURTSEYING as you're falling through the door, staring stupidly up.<br \/><br \/>Paso 4: Father William,' the young.<br \/><br \/>","ingredientes":"ingrediente6 472ml",
            "votos": 0,
            "user_id": 25,
            "created_at": "2005-09-03 00:00:00",
            "updated_at": null
        }
    ],

    "ultim_comentarios":[
        {
            "id": 15,
            "padre": null,
            "mensaje": "For, you see, Miss, we're.",
            "user_id": 25,
            "receta_id": 23,
            "time": 1548804659,
            "leido": 0,
            "created_at": "2000-05-21 06:34:54",
            "updated_at": "2000-05-21 06:34:54",
            "receta": null
        }
    ],

    "ultim_mens_contacto": []
};


*/





            },

        },
    }
</script>
