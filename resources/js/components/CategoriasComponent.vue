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
                  <h6 class="h2 text-white d-inline-block mb-0">Categorías</h6>
                  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                      <li class="breadcrumb-item">
                        <a href=""><i class="fas fa-home"></i></a>
                      </li>
                      <li class="breadcrumb-item"><a href="">Inicio</a></li>
                      <li class="breadcrumb-item active" aria-current="page"> Categorías </li>
                    </ol>
                  </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                  <button type="button" class="btn btn-sm btn-neutral" @click="fnNuevaCategoria()" id="nuevaCategoria">
                    Nuevo
                  </button>
                  <button type="button" class="btn btn-sm btn-neutral" @click="listar_categorias()">
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
                    <th scope="col" class="sort" data-sort="name">Código</th>
                    <th scope="col" class="sort" data-sort="budget">Nombre</th>
                    <th scope="col" class="sort" data-sort="status">Descripción</th>
                    <th scope="col"></th>
                  </tr>
                </thead>

                <tr v-for="categoria in lista_categorias" :key="categoria.id">
                  <th scope="row">
                    <div class="media align-items-center">
                      <div class="media-body">
                        <span class="name mb-0 text-sm">{{ categoria.id }}</span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    {{ categoria.codigo }}
                  </td>
                  <td class="budget">
                   {{ categoria.nombre }}
                  </td>
                  <td class="budget">
                   {{ categoria.descripcion }}
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" >
                        <button class="dropdown-item" @click="fnEditarCategoria(categoria)">
                          <span class="btn-inner--icon"><i class="ni ni-collection"></i></span>
                          <span class="btn-inner--text">Editar</span>
                        </button>
                        <button class="dropdown-item" @click="fnMostrarModalEliminarCategoria(categoria)">
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
      class="modal fade" id="modalNuevaCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Categoría</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Código de categoría</label>
                    <input type="text" class="form-control" v-model="nuevaCategoria.codigo" placeholder="Código de categoría" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" v-model="nuevaCategoria.nombre" placeholder="Nombre de la categoría" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Descripción</label>
                    <input type="text" class="form-control" v-model="nuevaCategoria.descripcion" placeholder="Descripción" />
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
              <h4 class="heading mt-4">Realmente desea eliminar la categoria</h4>
              <p> ISBN: {{ categoria_eliminar.codigo }}, Nombre: {{ categoria_eliminar.nombre }} </p>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-white" @click="fnEliminarCategoria(categoria)">
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
    this.listar_categorias();
  },
  data() {
    return {
      nuevaCategoria: {},
      errores: "",
      lista_categorias: {},
      categoria_eliminar: {},
    };
  },
  methods: {
    fnNuevaCategoria() {
      this.nuevaCategoria = {};
      //this.listar_categorias();
      $("#modalNuevaCategoria").modal("toggle");
    },
    async listar_categorias() {
      await axios.get("api/categorias").then((respuesta) => {
          console.log(respuesta.data);
          this.lista_categorias = respuesta.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },

    fnEditarCategoria(categoria) {
      this.nuevaCategoria = categoria;
      //this.listar_categorias();
      $("#modalNuevaCategoria").modal("toggle");
    },
    async guardar() {
      await axios.post("api/guardar_categoria", this.nuevaCategoria).then((respuesta) => {
          console.log(respuesta);
          $("#modalNuevaCategoria").modal("toggle");
          this.nuevaCategoria = {};
          this.errores = "";
          this.listar_categorias();
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

    fnMostrarModalEliminarCategoria(categoria) {
      this.categoria_eliminar = categoria;
      $("#modal-eliminar").modal("toggle");
    },
    async fnEliminarCategoria(categoria) {
      await axios.post("api/eliminar_categoria", this.categoria_eliminar).then((respuesta) => {
          console.log(respuesta);
          $("#modal-eliminar").modal("toggle");
          this.categoria_eliminar = {};
          this.listar_categorias();
        })
        .catch((error) => {
          
          console.log(error.response.data);
        });
    },
  },
};
</script>