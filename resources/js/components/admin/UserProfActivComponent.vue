<template>
    <div class="active tab-pane" id="activity">
        <h4><i class="fas fa-book-open"></i> Últimas Recetas</h4>
        <div id="accordion-ult-rec">
            <div v-if="objActivReg.ultim_recetas == ''" class="callout callout-info user-block">
                <span class="img-circle img-bordered-sm" title="Icono genérico de receta">
                    <i class="fas fa-book-open i_ultim_ninguno"></i>
                </span>
                <span>
                    Ninguna publicada aún
                </span>
            </div>
            <div v-else v-for="(receta, index) in objActivReg.ultim_recetas" :key="index" class="callout callout-info user-block">
                <img class="img-circle img-bordered-sm" :src="receta.imagen" alt="Foto de la receta">
                <a :href="'#reg-ult-rec-' + index" data-toggle="collapse" class="float-right text-sm tit_receta_plus" @click="changeIcon('ultim_recetas', index, $event)">
                    <i :id="'ico_onoff_ult_rec_' + index" class="fas fa-1x" :class="[ ultRects_accordBtns[index].collapsed ? 'fa-plus' : 'fa-minus' ]" :title="ultRects_accordBtns[index].title + ' contenido'"></i>
                </a>
                <span class="username">
                    <a href="#" class="tit_receta" target="_blank" title="Acceder al detalle">{{ receta.titulo }}</a>
                </span>
                <span class="description">Publicada - {{ receta.created_at }}</span>
                <div :id="'reg-ult-rec-' + index" class="collapse" :class="{'show': (index == 0)}" data-parent="#accordion-ult-rec">
                    <p>
                        {{ receta.descripcion }}
                    </p>
                    <p>
                        <span class="text-sm">
                            <i class="fas fa-star mr-1"></i> Votos ({{ receta.votos }})
                        </span>
                        <span class="float-right text-sm">
                            <i class="fas fa-comments mr-1"></i> Commentarios ({{ receta.comentarios.length }})
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <!-- /.Últimas Recetas -->

        <hr class="separador">

        <h4><i class="fas fa-comments"></i> Últimos Comentarios</h4>
        <div id="accordion-ult-com">
            <div v-if="objActivReg.ultim_comentarios == ''" class="callout callout-info user-block">
                <span class="img-circle img-bordered-sm" title="Icono genérico de comentario">
                    <i class="fas fa-comments i_ultim_ninguno"></i>
                </span>
                <span>
                    Ninguno publicado aún
                </span>
            </div>
            <div v-else v-for="(comentario, index) in objActivReg.ultim_comentarios" :key="index" class="callout callout-info user-block">
                <img class="img-circle img-bordered-sm" :src="comentario.user.avatar" alt="Foto del autor">
                <a :href="'#reg-ult-com-' + index" data-toggle="collapse" class="float-right text-sm tit_receta_plus" @click="changeIcon('ultim_comentarios', index, $event)">
                    <i :id="'ico_onoff_ult_com_' + index" class="fas fa-1x" :class="[ ultComs_accordBtns[index].collapsed ? 'fa-plus' : 'fa-minus' ]" :title="ultComs_accordBtns[index].title + ' contenido'"></i>
                </a>
                <span class="username">
                    en <a href="#" class="tit_receta" target="_blank" title="Acceder al detalle">{{ comentario.receta.titulo }}</a>
                </span>
                <span class="description">Publicado - {{ comentario.created_at }}</span>
                <div :id="'reg-ult-com-' + index" class="collapse" :class="{'show': (index == 0)}" data-parent="#accordion-ult-com">
                    <p>
                        {{ comentario.mensaje }}
                    </p>
                </div>
            </div>
        </div>
        <!-- /.Últimos Comentarios -->

        <hr class="separador">

        <h4><i class="fas fa-envelope"></i> Últimos Mens. Contacto</h4>
        <div id="accordion-ult-con">
            <div v-if="objActivReg.ultim_mens_contacto == ''" class="callout callout-info user-block">
                <span class="img-circle img-bordered-sm" title="Icono genérico de mensaje de contacto">
                    <i class="fas fa-envelope i_ultim_ninguno"></i>
                </span>
                <span>
                    Ninguno enviado aún
                </span>
            </div>
            <div v-else v-for="(mens_contacto, index) in objActivReg.ultim_mens_contacto" :key="index" class="callout callout-info user-block">
                <img class="img-circle img-bordered-sm" :src="objActivReg.user.avatar" alt="Foto del autor">
                <a :href="'#reg-ult-con-' + index" data-toggle="collapse" class="float-right text-sm tit_receta_plus" @click="changeIcon('ultim_mens_contacto', index, $event)">
                    <i :id="'ico_onoff_ult_con_' + index" class="fas fa-1x" :class="[ ultMsgsCon_accordBtns[index].collapsed ? 'fa-plus' : 'fa-minus' ]" :title="ultMsgsCon_accordBtns[index].title + ' contenido'"></i>
                </a>
                <span class="username">
                    por <a href="#" class="tit_receta" target="_blank" title="Acceder al detalle">{{ mens_contacto.nombre }}</a>
                </span>
                <span class="description">Enviado - {{ mens_contacto.created_at }}</span>
                <div :id="'reg-ult-con-' + index" class="collapse" :class="{'show': (index == 0)}" data-parent="#accordion-ult-con">
                    <p>
                        {{ mens_contacto.mensaje }}
                    </p>
                    <p>
                        <span class="float-right text-sm">
                            <i v-if="mens_contacto.leido" class="fas fa-circle i_mens_contacto_leidoOK" title="Leido"></i>
                            <i v-else class="fas fa-circle i_mens_contacto_leidoNOK" title="Sin leer"></i>
                        </span>
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
                urlBase: '/api/users',
                //variable para almacenar los datos del registro a almacenar
                objActivReg: {},
                element: '',
                element_parent: '',

                ultRects_accordBtns:[
                    { collapsed: false, title: 'Replegar', },
                    { collapsed: true, title: 'Desplegar', },
                    { collapsed: true, title: 'Desplegar', },
                ],
                ultComs_accordBtns:[
                    { collapsed: false, title: 'Replegar', },
                    { collapsed: true, title: 'Desplegar', },
                    { collapsed: true, title: 'Desplegar', },
                ],
                ultMsgsCon_accordBtns:[
                    { collapsed: false, title: 'Replegar', },
                    { collapsed: true, title: 'Desplegar', },
                    { collapsed: true, title: 'Desplegar', },
                ],
            }
        },

        methods: {

            /**
             * Cambio de icono en los "accordion"s tratados
             *
             * arrAccordBtns, el array de botones a tratar
             * index, el índice del array referido al botón pulsado
             * event, el evento lanzado a través del cuál se localiza
             * el elemento que recibe dicho evento
            */
            changeIcon(arrAccordBtns, index, event) {
                //NOTA EXTRA
                //Para recorrer el DOM por vue-devtools:
                //- Posicionarse en el elemento
                //- teclear la referencia inicial indicada $vm0
                //- a partir de ahí, sale un árbol de las opciones disponibles
                //-----------------------------------------------------------------
                //Elementos referenciados con REF
                ////console.log('ELEM-REFs-LOG => ' + this.$refs);
                //TagName del Elemento de destino del evento lanzado
                ////console.log('EVENT-TARGET => ' + event.target.tagName);
                ////console.log('EVENT-TARGET-parentElement.attributes => ' + event.target.parentElement.attributes);

                //Elemento que recibe el evento lanzado
                this.element = event.target;
                //console.log('this.element.id => ' + this.element.id)

                //Tratando el botón pulsado
                if (this.element.classList.contains('fa-plus')) {
                    //console.log('ICONO actual FA-PLUS pasa a FA-MINUS');

                    document.getElementById(this.element.id).classList.remove('fa-plus');
                    document.getElementById(this.element.id).classList.add('fa-minus');
                } else {
                    //console.log('ICONO actual FA-MINUS pasa a FA-PLUS');

                    document.getElementById(this.element.id).classList.remove('fa-minus');
                    document.getElementById(this.element.id).classList.add('fa-plus');
                }

                //Tratando los demás botones del mismo accordion según:
                //  >> el botón pulsado
                //  >> el estado de la parte del accordion
                //  a la que pertenece ese botón
                if(arrAccordBtns == 'ultim_recetas')
                {
                    this.ultRects_accordBtns.forEach(function(accordBtn) {
                        accordBtn.collapsed = true;
                        accordBtn.title = 'Desplegar';
                    })

                    this.ultRects_accordBtns[index].collapsed = !this.ultRects_accordBtns[index].collapsed;
                    if( this.ultRects_accordBtns[index].collapsed )
                        this.ultRects_accordBtns[index].title = 'Desplegar';
                    else
                        this.ultRects_accordBtns[index].title = 'Replegar';
                }
                else if(arrAccordBtns == 'ultim_comentarios')
                {
                    this.ultComs_accordBtns.forEach(function(accordBtn) {
                        accordBtn.collapsed = true;
                        accordBtn.title = 'Desplegar';
                    })

                    this.ultComs_accordBtns[index].collapsed = !this.ultComs_accordBtns[index].collapsed;
                    if( this.ultComs_accordBtns[index].collapsed )
                        this.ultComs_accordBtns[index].title = 'Desplegar';
                    else
                        this.ultComs_accordBtns[index].title = 'Replegar';
                }
                else if(arrAccordBtns == 'ultim_mens_contacto')
                {
                    this.ultMsgsCon_accordBtns.forEach(function(accordBtn) {
                        accordBtn.collapsed = true;
                        accordBtn.title = 'Desplegar';
                    })

                    this.ultMsgsCon_accordBtns[index].collapsed = !this.ultMsgsCon_accordBtns[index].collapsed;
                    if( this.ultMsgsCon_accordBtns[index].collapsed )
                        this.ultMsgsCon_accordBtns[index].title = 'Desplegar';
                    else
                        this.ultMsgsCon_accordBtns[index].title = 'Replegar';
                }
            },

            /**
             * Cargando datos de resumen
            */
            fillActivReg(regID) {
                console.log('Cargando datos de actividad del registro [' + regID + ']');
                //Haciendo la petición de datos
                let url = this.urlBase + '/prof-activity/' + regID;
                axios.get(url)
                .then( response => {       //SI TODO OK
                    console.log('Top Últimos Varios:', response.data);
                    this.objActivReg = response.data;
                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    console.log(error.response.data.errors);
                });
            },

        },
    }
</script>
