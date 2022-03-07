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
                  <h6 class="h2 text-white d-inline-block mb-0">Editoriales</h6>
                  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                      <li class="breadcrumb-item">
                        <a href=""><i class="fas fa-home"></i></a>
                      </li>
                      <li class="breadcrumb-item"><a href="">Inicio</a></li>
                      <li class="breadcrumb-item active" aria-current="page"> Editoriales </li>
                    </ol>
                  </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                  <button type="button" class="btn btn-sm btn-neutral" @click="fnNuevoEditorial()" id="nuevoEditorial">
                    Nuevo
                  </button>
                  <button type="button" class="btn btn-sm btn-neutral" @click="listar_editoriales()">
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

                <tr v-for="editorial in lista_editoriales" :key="editorial.id">
                  <th scope="row">
                    <div class="media align-items-center">
                      <div class="media-body">
                        <span class="name mb-0 text-sm">{{ editorial.id }}</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    {{ editorial.codigo }}
                  </td>
                  <td class="budget">
                   {{ editorial.nombre }}
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" >
                        <button class="dropdown-item" @click="fnEditarEditorial(editorial)">
                          <span class="btn-inner--icon"><i class="ni ni-collection"></i></span>
                          <span class="btn-inner--text">Editar</span>
                        </button>
                        <button class="dropdown-item" @click="fnMostrarModalEliminarEditorial(editorial)">
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
      class="modal fade" id="modalNuevoEditorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editorial</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Código de la editorial</label>
                    <input type="text" class="form-control" v-model="nuevoEditorial.codigo" placeholder="Código" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nombre de la editorial</label>
                    <input type="text" class="form-control" v-model="nuevoEditorial.nombre" placeholder="Nombre de la editorial" />
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
              <h4 class="heading mt-4">Realmente desea eliminar la editorial</h4>
              <p> ISBN: {{ editorial_eliminar.codigo }}, Nombre: {{ editorial_eliminar.nombre }} </p>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-white" @click="fnEliminarEditorial(editorial)">
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
    this.listar_editoriales();
  },
  data() {
    return {
      nuevoEditorial: {},
      errores: "",
      lista_editoriales: {},
      editorial_eliminar: {},
    };
  },
  methods: {
    fnNuevoEditorial() {
      this.nuevoEditorial = {};
      $("#modalNuevoEditorial").modal("toggle");
    },
    async listar_editoriales() {
      await axios.get("api/editoriales").then((respuesta) => {
          console.log(respuesta.data);
          this.lista_editoriales = respuesta.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },

    fnEditarEditorial(editorial) {
      this.nuevoEditorial = editorial;
      $("#modalNuevoEditorial").modal("toggle");
    },
    async guardar() {
      await axios.post("api/guardar_editorial", this.nuevoEditorial).then((respuesta) => {
          console.log(respuesta);
          $("#modalNuevoEditorial").modal("toggle");
          this.nuevoEditorial = {};
          this.errores = "";
          this.listar_editoriales();
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

    fnMostrarModalEliminarEditorial(editorial) {
      this.editorial_eliminar = editorial;
      $("#modal-eliminar").modal("toggle");
    },
    async fnEliminarEditorial(editorial) {
      await axios.post("api/eliminar_editorial", this.editorial_eliminar).then((respuesta) => {
          console.log(respuesta);
          $("#modal-eliminar").modal("toggle");
          this.editorial_eliminar = {};
          this.listar_editoriales();
        })
        .catch((error) => {
          
          console.log(error.response.data);
        });
    },
  },
};
</script>