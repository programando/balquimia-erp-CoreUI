<template>
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <strong>Registro de Pedidos</strong>

                  </div>
                  <button @click="BuscarCliente()"> Consulta</button>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label for="name">Cliente</label>

                         <!-- <selectsearch
                              UrlSearch        ='/terceros/clientes/buscar'
                              @AsignarIdTercero="AsignarIdTercero">
                          </selectsearch>
                            -->
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="name">Vendedor</label>
                          <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="name">Fecha Despacho</label>
                          <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                      </div>

                    </div>
                    <!--/.row-->

                    <div class="row">
                      <div class="col-sm-1">
                        <div class="form-group">
                          <label for="ccnumber">Prom.Pago</label>
                          <input type="text" class="form-control" id="ccnumber" >
                        </div>
                      </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                          <label for="ccnumber">Nro.Ord.Cpra.</label>
                          <input type="text" class="form-control" id="ccnumber" >
                        </div>
                      </div>
                     <div class="col-sm-8">
                        <div class="form-group">
                          <label for="ccnumber">Observaciones Pedido</label>
                          <input type="text" class="form-control" id="ccnumber" >
                        </div>
                      </div>

                    </div>
                    <!--/.row-->
                <div class="row">
                  <div class="col-sm-12">

<ul class="nav nav-tabs" id="myTab1" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Últimas Ventas</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pedido Generado</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Estado de cuenta</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTab1Content">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater
                        eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.
                      </div>
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo
                        enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny
                        pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.
                      </div>
                      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy
                        hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't
                        heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.
                      </div>
                    </div>
                    <hr/>




                  </div>
                </div>

                  </div>
                </div>
              </div>

            </div>


          </div>

</template>
<script>
//import vSelect   from 'vue-select';

  export default {
      data(){
          return {
              ClientesArray : [],
              id_terc       : 0,
          }
      },

      methods: {
          AsignarIdTercero( IdClienteSelecionado ){
              this.id_terc = IdClienteSelecionado;
          },

          BuscarCliente(){
              axios.get('/terceros/buscar')
              .then( response =>{
                  console.log( response.data )
              })
              .catch( error =>{
                 console.log( error );
              })
          }

      }
  };

</script>
