<div class="row">
    <div class="col-12 text-right">
        <form action="{{ route('users.destroy', $user->id) }}" id="formEliminarUsuario" method="POST" onsubmit="return confirmarEliminacion();">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> Eliminar
            </button>
            <a class="btn btn-info" href="{{ route('user_reset_password', $user->id) }}">Resetear Contraseña</a>
        </form>
    </div>
</div>