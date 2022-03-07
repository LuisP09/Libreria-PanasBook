<template>
  <div>
    <!-- Header -->
    <div class="header bg-gradient-dark pt-5 pt-md-6">
      <div class="container-fluid">
        <div class="header pb-6">
          <div class="container-fluid">
            <div class="header-body">
              <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                  <h6 class="h2 text-white d-inline-block mb-0">Autores</h6>
                  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                      <li class="breadcrumb-item">
                        <a href=""><i class="fas fa-home"></i></a>
                      </li>
                      <li class="breadcrumb-item"><a href="">Inicio</a></li>
                      <li class="breadcrumb-item active" aria-current="page"> Autores </li>
                    </ol>
                  </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                  <button type="button" class="btn btn-sm btn-neutral" @click="fnNuevoAutor()" id="nuevoAutor">
                    Nuevo
                  </button>
                  <button type="button" class="btn btn-sm btn-neutral" @click="listar_autores()">
                    Recargar
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Header -->
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">ID</th>
                    <th scope="col" class="sort" data-sort="name">Codigo</th>
                    <th scope="col" class="sort" data-sort="budget">Nombre</th>
                    <th scope="col"></th>
                  </tr>
                </thead>

                <tr v-for="autor in lista_autores" :key="autor.id">
                  <th scope="row">
                    <div class="media align-items-center">
                      <div class="media-body">
                        <span class="name mb-0 text-sm">{{ autor.id }}</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    {{ autor.codigo }}
                  </td>
                  <td class="budget">
                   {{ autor.nombre }}
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" >
                        <button class="dropdown-item" @click="fnEditarAutor(autor)">
                          <span class="btn-inner--icon"><i class="ni ni-collection"></i></span>
                          <span class="btn-inner--text">Editar</span>
                        </button>
                        <button class="dropdown-item" @click="fnMostrarModalEliminarAutor(autor)">
                          <span class="btn-inner--icon"
                            ><i class="ni ni-fat-remove"></i
                          ></span>
                          <span class="btn-inner--text">Eliminar</span>
                        </button>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <!-- End Light table -->
          </div>
        </div>
      </div>
    </div>

    <!-- End Page content -->
    <!-- Modal -->
    <div
      class="modal fade" id="modalNuevoAutor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Autor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Código del autor</label>
                    <input type="text" class="form-control" v-model="nuevoAutor.codigo" placeholder="Código" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nombre del Autor</label>
                    <input type="text" class="form-control" v-model="nuevoAutor.nombre" placeholder="Nombre del Autor" />
                  </div>
                </div>
                
                <div class="col-md-12" v-if="errores">
                  <div class="alert alert-warning" role="alert">
                    <span class="alert-inner--icon" ><i class="ni ni-like-2"></i ></span>
                    <span class="alert-inner--text" ><strong>Warning!</strong> {{ errores }}</span>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Cerrar
            </button>
            <button type="button" class="btn btn-primary" @click="guardar()">
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- modal eliminar-->
    <div class="modal fade" id="modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
      <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-notification"> Your attention is required </h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="py-3 text-center">
              <i class="ni ni-bell-55 ni-3x"></i>
              <h4 class="heading mt-4">Realmente desea eliminar el autor</h4>
              <p> ISBN: {{ autor_eliminar.codigo }}, Nombre: {{ autor_eliminar.nombre }} </p>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-white" @click="fnEliminarAutor(autor)">
              Eliminar
            </button>
            <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</template>
<script>
export default {
  setup() {},
  mounted() {
    this.listar_autores();
  },
  data() {
    return {
      nuevoAutor: {},
      errores: "",
      lista_autores: {},
      autor_eliminar: {},
    };
  },
  methods: {
    fnNuevoAutor() {
      this.nuevoAutor = {};
      $("#modalNuevoAutor").modal("toggle");
    },
    async listar_autores() {
      await axios.get("api/autores").then((respuesta) => {
          console.log(respuesta.data);
          this.lista_autores = respuesta.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },

    fnEditarAutor(autor) {
      this.nuevoAutor = autor;
      $("#modalNuevoAutor").modal("toggle");
    },
    async guardar() {
      await axios.post("api/guardar_autor", this.nuevoAutor).then((respuesta) => {
          console.log(respuesta);
          $("#modalNuevoAutor").modal("toggle");
          this.nuevoAutor = {};
          this.errores = "";
          this.listar_autores();
        })
        .catch((error) => {
          console.log(error.response.data);

          if (error.response.data.errors != null) {
            var llaves = Object.keys(error.response.data.errors);
            this.errores = error.response.data.errors[llaves[0]][0];
          } else {
            this.errores = error.message;
          }
        });
    },

    fnMostrarModalEliminarAutor(autor) {
      this.autor_eliminar = autor;
      $("#modal-eliminar").modal("toggle");
    },
    async fnEliminarAutor(autor) {
      await axios.post("api/eliminar_autor", this.autor_eliminar).then((respuesta) => {
          console.log(respuesta);
          $("#modal-eliminar").modal("toggle");
          this.autor_eliminar = {};
          this.listar_autores();
        })
        .catch((error) => {
          
          console.log(error.response.data);
        });
    },
  },
};
</script>