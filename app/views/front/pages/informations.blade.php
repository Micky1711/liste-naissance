@extends('layouts.front')

@section('content')
     <section id="blog" class="container">
        <div class="center">
            <h2>Informations / Notre philosophie</h2>
            <p class="lead">Explications sur le fonctionnement de la liste de naissance</p>
        </div>

        <div class="blog">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-item">
                        <img class="img-responsive img-blog" src="/assets/img/images/blog/blog1.jpg" width="100%" alt="" />
                     </div><!--/.blog-item-->
                     <p>Avant toute chose, nous avons choisi de développer notre propre liste de naissance afin de ne pas être obligés et limités par les enseignes commerciales.<br>
                     Obligés de se fournir chez eux à des prix exagérement élevés à leurs conditions que nous jugeons inacceptables.<br>
                     Limités dans le choix des articles sans pouvoir faire appels à la concurrence.</p>
                     <p>En faisant le choix de faire notre propre site pour la liste de naissance, nous offrons un maximum de flexibilité et possibilité aussi bien au niveau du choix des articles à offrir que de la manière de l'offrir.</p>
                     <p>Plus d'information dans la FAQ si dessous.</p>
                </div><!--/.col-md-12-->
            </div><!--/.row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-item">
                    <div class="accordion">
                        <h2>Questions fréquemment posées</h2>
                        <div class="panel-group" id="accordion1">
                          <div class="panel panel-default">
                            <div class="panel-heading active">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1">
                                    Comment vos offrir un cadeau pour votre bébé ?
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseOne1" class="panel-collapse collapse in">
                              <div class="panel-body">
                                  <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="images/accordion1.png">
                                        </div>
                                        <div class="media-body">
                                             <h4>Adipisicing elit</h4>
                                             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore</p>
                                        </div>
                                  </div>
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1">
                                    Je ne souhaite pas vous offrir un cadeau de la liste mais un cadeau un autre ?
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseTwo1" class="panel-collapse collapse">
                              <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1">
                                    Je ne souhaite pas vous achetez un cadeau, je préfère vous envoyer de l'argent ?
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseThree1" class="panel-collapse collapse">
                              <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseFour1">
                                    J'aimerai vous offrir un cadeau mais n'ai pas trop envie d'aller faire les magasins ?
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseFour1" class="panel-collapse collapse">
                              <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
                              </div>
                            </div>
                          </div>
                        </div>
                    </div><!--/#accordion1-->
                    </div>
                </div><!--/.col-md-12-->
            </div><!--/.row-->
         </div><!--/.blog-->
    </section>



@stop