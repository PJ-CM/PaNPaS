<template>
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
                src="https://lorempixel.com/640/480/?71944"
                alt="Avatar del usuario">
        </div>

        <h3 class="profile-username text-center">Nina Mcintire</h3>

        <h5 class="text-muted text-center">@laKata</h5>

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <strong>Recetas</strong> <a class="float-right">13,287</a>
            </li>
            <li class="list-group-item">
                <strong>Comentarios</strong> <a class="float-right">13,287</a>
            </li>
            <li id="top-msgs-contact" class="list-group-item">
                <strong>Mens. Contacto</strong> <a class="float-right">13,287</a>
            </li>
            <li id="top-followers" class="list-group-item">
                <strong>Seguidores</strong> <a class="float-right">1,322</a>
            </li>
            <li class="list-group-item">
                <strong>Siguiendo a</strong> <a class="float-right">543</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
