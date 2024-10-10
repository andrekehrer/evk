<?php require('header.php'); ?>
<?php require('menu.php'); ?>
  <style>
    .bota0_comprar{background: #2d2e47;padding: 6px 30px;width: 100%;color: white !important;cursor:pointer}
    li {font-size: 12px;}
    .wt_btn{background: #25D366;color: white;padding: 20px 40px;width: 300px;cursor:pointer}
    .wt_btn:hover{color: white;}
    .wt_img{width: 30px;margin-top: -7px;margin-left: 10px;}
    @media (min-width: 992px){
      .col-lg-2 {
          flex: 0 0 auto;
          width: 20%;
      }
    }
    #qtd_cart{background: #4cc5c0;color: white;border-radius: 50%;width: 20px;height: 20px;padding: 1px 7px;margin-top: 7px;margin-left: -1px;float:left}
    .btn_aviso{background: #4dc4c0c7;font-size: 12px;width: 92%;text-align: center;margin-top: 12px;margin-top: 10px;color: white;}
  </style>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Indo viajar ?<br> Sabe a cor, marca, tamanho e o que colocou na sua bagagem?</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">25 milhões de bagagens são extraviadas por ano no mundo, 48 malas por minuto no ano! Se isso não ocorreu com você é provável que conheça com quem já!</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Se Previna</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="<?=base_url(); ?>assets/img/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

		<div class="container" data-aos="fade-up">
			<div class="row gx-0">

				<div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
					<div class="content">
						<h3>----</h3>
						<h2>A sua viagem de fato começa aqui.</h2>
						<p>
							Depois do check-in que de fato começa a sua viagem. Para não ser pego de surpresa caso algum problema ocorra com sua bagagem se previna! Para te ajudar a mythreepi organiza todas as suas fotos, descrições de itens, notas fiscais, comprovantes e deixa tudo pronto caso você precise . Registre sua bagagem antes de viajar. Sua bagagem precisa estar com você ou o dano reparado.
						</p>
					</div>
				</div>

				<div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
					<img src="<?=base_url(); ?>assets/img/about.jpg" class="img-fluid" alt="">
				</div>

			</div>
		</div>

    <div class="container" data-aos="fade-up">
			<div class="row gx-0">
				<div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
					<img src="<?=base_url(); ?>assets/img/traceme.jpg" class="img-fluid" alt="">
				</div>

				<div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
					<div class="content">
            <h3>----</h3>
						<h2>Parceria de distribuição rastreador Trace Me</h2>
            <p>
              Em parceria com a Empresa Trace Me, sediada no Reino Unido, ajudaremos que a sua bagagem não seja nunca extraviada em definitivo. A Trace me é uma das seletas empresas no Mundo que tem sua tecnologia reconhecida pela SITA, empresa que desenvolveu o Worldtracer , sistema utilizado para rastrear as bagagens.							
            </p>
						<div class="text-center text-lg-start">
							<a href="https://www.tmlt.co.uk" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
								<span>Conheça a Trace Me </span>
								<i class="bi bi-arrow-right"></i>
							</a>
						</div>
            <br>
            <div class="text-center text-lg-start">
							<a href="<?=base_url(); ?>assets/img/tracemeuk.pdf" target="_blank" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
								<span>Baixe o PDF</span>
								<i class="bi bi-arrow-right"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

    </section><!-- End About Section -->

    <!-- ======= Values Section ======= -->
    <!-- <section id="values" class="values">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Our Values</h2>
          <p>Odit est perspiciatis laborum et dicta</p>
        </header>

        <div class="row">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
              <img src="<?=base_url(); ?>assets/img/values-1.png" class="img-fluid" alt="">
              <h3>Ad cupiditate sed est odio</h3>
              <p>Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit. Et veritatis id.</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
            <div class="box">
              <img src="<?=base_url(); ?>assets/img/values-2.png" class="img-fluid" alt="">
              <h3>Voluptatem voluptatum alias</h3>
              <p>Repudiandae amet nihil natus in distinctio suscipit id. Doloremque ducimus ea sit non.</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
            <div class="box">
              <img src="<?=base_url(); ?>assets/img/values-3.png" class="img-fluid" alt="">
              <h3>Fugit cupiditate alias nobis.</h3>
              <p>Quam rem vitae est autem molestias explicabo debitis sint. Vero aliquid quidem commodi.</p>
            </div>
          </div>

        </div>

      </div>

    </section> -->

    <!-- ======= Counts Section ======= -->
    <!-- <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-emoji-smile"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                <p>Happy Clients</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-journal-richtext" style="color: #ee6c20;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                <p>Projects</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-headset" style="color: #15be56;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
                <p>Hours Of Support</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-people" style="color: #bb0852;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                <p>Hard Workers</p>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section> -->

    <!-- ======= COMO FUNCIONA ======= -->
    <!-- <section id="services" class="services">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Como Funciona</h2>
          <p>Entenda o passo-a-passo</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-box blue">
              <i class="ri-discuss-line icon"></i>
              <h3>Nesciunt Mete</h3>
              <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.</p>
              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-box orange">
              <i class="ri-discuss-line icon"></i>
              <h3>Eosle Commodi</h3>
              <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-box green">
              <i class="ri-discuss-line icon"></i>
              <h3>Ledo Markt</h3>
              <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-box red">
              <i class="ri-discuss-line icon"></i>
              <h3>Asperiores Commodi</h3>
              <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>
              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-box purple">
              <i class="ri-discuss-line icon"></i>
              <h3>Velit Doloremque.</h3>
              <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
            <div class="service-box pink">
              <i class="ri-discuss-line icon"></i>
              <h3>Dolori Architecto</h3>
              <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

        </div>

      </div>

    </section> -->
    <!-- End COMO FUNCIONA -->
      <div class="toast" style="position: absolute; top: 0; right: 0;">
        <div class="toast-header">
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
          Item adicionado ao carrinho.
        </div>
      </div>
    
    <!-- ======= Pricing Section ======= -->
    <section id="produtos" class="produtos">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Nossos Produtos</h2>
          <p>Personalize e identifique sua bagagem</p>
        </header>

        <div class="row gy-4" data-aos="fade-left">

          <div class="col-lg-2 col-md-6 col-sm-6 col-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="box">
              <h3 style="color: #07d5c0;min-height: 67px;">Registre sua Bagagem</h3>
              <div class="price">Free</div>
              <img src="<?=base_url(); ?>assets/img/register.png" class="img-fluid" alt="">
              
              <ul style="margin-top:10px">
                <li>Código de identificação</li>
                <li>Simples de usar, sem partes móveis ou baterias.</li>
                <li>Atendimento ao cliente 24/7 em qualquer idioma.</li>
                <li>Global Cover – qualquer companhia aérea, qualquer aeroporto.</li>
                <li>-</li>
              </ul>
              <a onclick="add_carrinho(this)" data-id="1" data-nome="Registre sua Bagagem" data-preco="0" class="btn-buy bota0_comprar">Adicionar no carrinho</a>
              <p class="btn_aviso" style="display:none" id="prod_1">Item adicionado no carrinho</p>
              <!-- <a href="<?php echo base_url() . 'cadastro/buy/'; ?>">
                  Pay via PayPal
              </a> -->
            </div>
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6 col-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="box">
              <h3 style="color: #07d5c0;min-height: 67px;">Selfie PrintID TraceMe</h3>
              <div class="price"><sup>R$ </sup>30,00</div>
              <img src="<?=base_url(); ?>assets/img/trace_product.png" class="img-fluid" alt="">
              
              <ul style="margin-top:10px">
                <li>Código de identificação</li>
                <li>Simples de usar, sem partes móveis ou baterias.</li>
                <li>Atendimento ao cliente 24/7 em qualquer idioma.</li>
                <li>Global Cover – qualquer companhia aérea, qualquer aeroporto.</li>
                <li>-</li>
              </ul>
              <!-- <a href="<?=base_url()?>assets/img/WOWSPT_PT.pdf" class="btn-buy bota0_comprar">COMPRAR</a> -->
              <a onclick="add_carrinho(this)" data-id="2" data-nome="Selfie PrintID" data-preco="30" class="btn-buy bota0_comprar">Adicionar no carrinho</a>
              <p class="btn_aviso" style="display:none" id="prod_2">Item adicionado no carrinho</p>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6 col-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="box">
              <h3 style="color: #07d5c0;min-height: 67px;">Trace me VIP 250</h3>
              <div class="price"><sup>R$ </sup>45,00</div>
              <img src="<?=base_url(); ?>assets/img/vip_250.png" class="img-fluid" alt="">
              <ul style="margin-top:10px">
                <li>Código de identificação</li>
                <li>Simples de usar, sem partes móveis ou baterias.</li>
                <li>Atendimento ao cliente 24/7 em qualquer idioma.</li>
                <li>Global Cover – qualquer companhia aérea, qualquer aeroporto.</li>
                <li>Provável compensação $250</li>
              </ul>
              <a onclick="add_carrinho(this)" data-id="3" data-nome="Trace me VIP 250" data-preco="45" class="btn-buy bota0_comprar">Adicionar no carrinho</a>
              <p class="btn_aviso" style="display:none" id="prod_3">Item adicionado no carrinho</p>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6 col-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="box">
              <h3 style="color: #65c600;min-height: 67px;">Trace me VIP 500</h3>
              <div class="price"><sup>R$ </sup>65,00</div>
              <img src="<?=base_url(); ?>assets/img/vip_500.png" class="img-fluid" alt="">
              
              <ul style="margin-top:10px">
                <li>Código de identificação</li>
                <li>Simples de usar, sem partes móveis ou baterias.</li>
                <li>Atendimento ao cliente 24/7 em qualquer idioma.</li>
                <li>Global Cover – qualquer companhia aérea, qualquer aeroporto.</li>
                <li>Provável compensação $500</li>
              </ul>
              <a onclick="add_carrinho(this)" data-id="4" data-nome="Trace me VIP 500" data-preco="65" class="btn-buy bota0_comprar">Adicionar no carrinho</a>
              <p class="btn_aviso" style="display:none" id="prod_4">Item adicionado no carrinho</p>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6 col-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="box">
              <h3 style="color: #ff901c;min-height: 67px;">Trace me VIP 1000</h3>
              <div class="price"><sup>R$ </sup>85,00</div>
              <img src="<?=base_url(); ?>assets/img/vip_1000.png" class="img-fluid" alt="">
              
              <ul style="margin-top:10px">
                <li>Código de identificação</li>
                <li>Simples de usar, sem partes móveis ou baterias.</li>
                <li>Atendimento ao cliente 24/7 em qualquer idioma.</li>
                <li>Global Cover – qualquer companhia aérea, qualquer aeroporto.</li>
                <li>Provável compensação $1000</li>
              </ul>
              <a onclick="add_carrinho(this)" data-id="5" data-nome="Trace me VIP 1000" data-preco="85" class="btn-buy bota0_comprar">Adicionar no carrinho</a>
              <p class="btn_aviso" style="display:none" id="prod_5">Item adicionado no carrinho</p>
            </div>
          </div>
          

        </div>

      </div>

    </section><!-- End Pricing Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <h2>F.A.Q</h2>
          <p>Causas mais frequentes de extravio de bagagem</p>
        </header>
        <div class="row">
          <div class="col-lg-12">
            <!-- F.A.Q List 1-->
            <div class="accordion accordion-flush" id="faqlist1">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                    1 - Conexões
                  </button>
                </h2>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body"><br>
                      Ao trocar de um avião para outro, a mala não embarca no próximo voo. Esta é a ocorrência mais frequente. <br><br>

                      As chances disso acontecer aumentam em caso de tempo curto de conexão, pois as cias aéreas se esforçam para não atrasarem seus voos e isso pode ocasionar até em deixar bagagens para trás.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                    2- Perda da identificação da mala
                  </button>
                </h2>
                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body"><br>
                    Quando há perda da tag de identificação, o profissional responsável fica sem saber para onde enviar a mala sem destino. <br><br>

                    Ela fica “perdida” até que seu dono faça a reclamação. Daí começará a busca por ela.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                    3 - Falha da companhia aérea
                  </button>
                </h2>
                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body"><br>
                    O equívoco da companhia aérea ou da terceirizada responsável, em determinado momento entre check-in e a colocação da bagagem na esteira pode acontecer.   <br><br>

                    Ou ainda, algum problema na logística de transporte, que pode acontecer por alguns motivos, desde falha da cia aérea, devido à grande quantidade de volumes ou tempo curto, até o erro humano por lapso, mesmo, entre outros.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-1">
                    4 - Furto
                  </button>
                </h2>
                <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body"><br>
                    Pode acontecer no aeroporto na área interna, na esteira ou na parte externa. Levam a mala sem a pessoa perceber.
                    <br>
                    Além do furto, também pode acontecer de alguém com a mala parecida com a sua retirá-la por engano.
                    <br>
                    Nesse caso, verifique se seu plano contratado oferece indenização e sob quais condições.
                    <br>
                    Como reduzir o risco de bagagem extraviada?
                    <br>
                    Faça um bom planejamento de voo. Nem sempre podemos escolher de acordo com todos os nossos critérios. Ainda mais quando surge uma oportunidade de passagem com desconto imperdível e garantimos logo para não deixar escapar;
                    <br>
                    Mas dentro do possível, tente evitar conexões entre diferentes companhias aéreas e também as curtas (com menos de 1 hora para voos nacionais e 2 horas para voos internacionais).
                    <br>
                    Faça o check-in com antecedência. Não deixe para despachar a bagagem em cima da hora de embarcar. Atrasando no check-in, você pode dificultar para a mala chegar em tempo válido à aeronave.
                    <br>
                    Certifique-se de que não há etiquetas de voos anteriores em sua bagagem. Confira a pesagem e a adesivação de sua mala, que deverá indicar seu destino final;
                    <br>
                    Informe-se sobre os procedimentos para pegar a bagagem (por exemplo, em caso de conexão nos Estados Unidos você tem que retirá-la na cidade onde fará a imigração para despachá-la ao destino final);
                    <br>
                    Coloque identificação dentro e fora da sua mala: a MyThreePi te ajuda a identificar sua bagagem por dentro e por fora , a fim de que diminua muito a chance de sua bagagem se perder em definitivo;
                    <br>
                    Faça uso de cadeados. No caso de viagem aos EUA, utilize o modelo com selo TSA pois podem abrir sua mala na alfândega. Esteja atento todo o tempo. Não descuide de seus pertences;
                    <br>
                    Personalize sua mala, tornando-a diferente das demais, principalmente se ela tiver cor comum. Para isso, identifique-a com um lenço colorido, adesivos, tags MythreePi, etc. Isso evitará dela ser levada por engano por outro viajante.
                    Leve os itens essenciais na bagagem de mão. Não dê sorte ao azar. Se a bagagem despachada se perder, você se previne .
                    <br>
                    Objetos valiosos e de primeira necessidade devem ir na mala de mão. Agasalho, troca de roupa, itens de higiene pessoal, remédios, cartões, dinheiro, joias, eletrônicos.
                    <br>
                    Minha bagagem foi extraviada: o que fazer?
                    <br>
                    Se você desembarcar, ir até a esteira e esperar, esperar e esperar pela companheira que não vem, infelizmente terá que constatar que sua bagagem foi extraviada. Primeiro passo: mantenha a calma.
                    <br>
                    Quando ficamos nervosos acabamos agindo contra nós mesmos. Em situações tensas, se não focarmos apenas em resolver o problema, podemos misturar emoções e gastar energia onde não precisamos. Então, respire e planeje. Como localizar a bagagem extraviada?
                    <br>
                    Vá até algum funcionário próximo à esteira ou ao guichê da companhia e informe o acontecido o mais breve possível. Apresente o comprovante de despacho de bagagem.
                    <br>
                    O profissional vai te ajudar no preenchimento do RIB (Relatório de Irregularidade de Bagagem). Também conhecido por “PIR” (Property Irregularity Report). É essencial redigir o RIB para oficializar o ocorrido para a cia aérea.
                    <br>
                    Se não for possível providenciar o RIB ainda no aeroporto, você terá um prazo de até 7 dias para fazê-lo. Mas isso diminui as chances de conseguir a indenização pela bagagem extraviada.
                    <br>
                    É possível também entrar em contato via SAC ou e-mail e documentar formalmente a reclamação, para garantir esse registro.
                    <br>
                    E caso suspeite ou confirme de alguma forma que sua mala foi furtada, faça, além do RIB, um boletim de ocorrência na polícia, citando a companhia aérea, número do voo e todas as informações possíveis.
                    <br>
                    Para acontecimento de danos à bagagem, tire fotos das partes deterioradas e faça um relato referente aos danos à companhia aérea.
                    <br>
                    Em caso de sinais de violação e retirada de algum item, exija que a empresa pese a bagagem danificada e entregue um comprovante, para comparar os pesos da mala no embarque e no destino.
                    <br>
                    Qual o prazo para reclamar o extravio de bagagem?
                    <br><br>
                    Fique atento! Você tem até 15 dias após o desembarque para reclamar o extravio de bagagem. O ideal é que o faça o quanto antes, preferencialmente ainda no aeroporto, seguindo todos os passo dados neste artigo.
                    <br>
                    Em caso de dano ou violação da bagagem, o prazo é de 7 dias para protestar e a companhia aérea também tem até 7 dias para fazer a substituição ou repara o dano. E dentro deste prazo também deve fazer a compensação financeira pela violação.
                    <br>
                    Qual o prazo para encontrarem e devolverem a mala extraviada?
                    <br>
                    O prazo para devolverem a mala é de até 7 dias, caso não seja entregue imediatamente. Se em 7 dias a bagagem não aparecer e o dono tiver aberto o processo de indenização, a companhia aérea terá uma semana para arcar com o prejuízo.
                    <br>
                    Antes da atualização de regras da ANAC, o prazo era de 30 dias. Um tempo muito longo para quem claramente precisa dos seus pertences com a maior urgência possível. As novas regras chegaram para favorecer os viajantes!
                    <br>
                    O limite de 30 dias para ser indenizado pela companhia caiu para 7 dias, e, com uma diferença tão grande de prazo, é de se esperar que as companhias não se adequem às novas regras logo de cara.
                    <br>
                    Qual o prazo para receber a indenização por extravio de bagagem?
                    <br>
                    Atualmente, assim que constatado o extravio de bagagem e o passageiro preencher o RIB e apresentar o comprovante de despacho da mala, após registrar sua reclamação, a companhia tem até 7 dias para realizar a indenização de bagagem extraviada.
                    <br>
                    Para custos emergenciais, as companhias aéreas são obrigadas a pagar uma indenização imediata ao passageiro que tiver a bagagem extraviada. Isso está previsto nas normas da ANAC.
                    <br>
                    O que fazer se o valor da indenização não for satisfatório?
                    <br>
                    A melhor coisa a fazer é buscar ajuda nos órgãos de defesa do consumidor. O Procon se orienta pelo Código de Defesa do Consumidor naquilo que mais beneficia a vítima.
                    <br>
                    Mas o Procon também respeita a Convenção de Varsóvia, que regula os voos internacionais, e só entra em ação se o passageiro comprovar que fez todos os procedimentos dentro das normas de despacho de bagagem e que levava o valor alegado.
                    <br>
                    Então, se você avaliar que o problema das malas arruinou sua viagem, o que resta é recorrer à justiça. Você pode ainda registrar uma reclamação no Departamento de Aviação Civil (DAC), que tem competência legal para multar as companhias aéreas.
                    <br>
                    Apesar de o DAC não ter poder para indenizar a vítima, pode contribuir para facilitar o processo, tendo o contato direto com a empresa responsável pelo inconveniente.
                    <br>
                    Extravio de bagagem dá dano moral?
                    <br>
                    Muita gente fica tão desiludido com esse incidente que procura requerer de forma mais incisiva a compensação dos danos. Sim. Extravio de bagagem pode gerar danos morais.
                    <br>
                    Se o consumidor se sentir lesado por todo o transtorno do extravio ou danificação da mala, poderá recorrer ao Juizado Especial Cível ou à Justiça comum, para solicitar indenização por danos morais e materiais.
                    <br>
                    Se a mala foi entregue danificada, tire fotos das avarias e tenha o bilhete aéreo como comprovante de viagem.
                    <br>
                    É importante guardar todos os recibos e notas fiscais de compras realizadas durante o período que esteve sem os pertences, como roupas e artigos de higiene pessoal para pedido de reembolso do que foi gasto.
                    ANAC e extravio de bagagem
                    <br>
                    A Agência Nacional de Aviação Civil (ANAC), uma das agências reguladoras federais do país, fiscaliza as atividades da aviação civil e a infraestrutura aeronáutica e aeroportuária no Brasil.
                    <br>
                    De acordo com a resolução da ANAC sobre extravio de bagagem, as empresas têm o prazo de até 7 dias (para voos domésticos), e 21 dias (voos internacionais) para darem retorno. Esse período foi estipulado para tornar o processo mais justo para o passageiro.
                    <br>
                    Se a bagagem for encontrada pela empresa aérea, terá que ser entregue no endereço informado pelo viajante. Caso a bagagem que foi despachada não seja localizada ou entregue nos prazos mencionados acima, a empresa deve indenizar o passageiro no prazo máximo de 7 dias:
                    <br>
                    Direitos do consumidor em caso de extravio de bagagem
                    <br>
                    A partir do check-in a companhia torna-se responsável pela sua bagagem e deve indenizá-lo em caso de extravio ou dano, de acordo com o artigo 6.º, VI e 14 do CDC (Código de Defesa do Consumidor).
                    <br>
                    E mais: se a viagem tiver sido adquirida por meio de agência de turismo, ela também responderá pelo incidente.
                    <br>
                    Se a empresa aérea não devolver a bagagem de imediato, o passageiro tem o direito de receber da companhia um ressarcimento pelos gastos com itens de primeira necessidade, pelo período em que estiver sem seus pertences, contanto que esteja fora do seu município.
                    <br>
                    É de responsabilidade das companhias aéreas definirem a maneira e os limites diários de compensação e estas deverão fazer o pagamento desses custos em até 7 dias, a partir da apresentação dos comprovantes de compra pelo passageiro.
                    <br>
                    Esse valor pode variar devido a rota e empresa, mas fica em torno de US$ 150 em voos para o exterior ou R$380 no Brasil. Guarde todos os recibos e comprovantes.
                    <br>
                    Se seus pertences forem entregues com atraso maior que 72 horas de seu desembarque, você poderá ter uma compensação financeira maior.
                    <br><br>
                    Ficou alguma dúvida sobre a mala extraviada?
                    <br>
                    Fale com a gente, estamos à sua disposição.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-2">
                    5 - Como a MyThreePi quer te ajudar em tudo que ocorrer com sua bagagem?
                  </button>
                </h2>
                <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body"><br>
                    Registre sua bagagem : se organize e cadastre em 10 minutos tudo o que tem dentro da sua bagagem antes de viajar. Caso tenha algum problema com sua bagagem terá como provar o conteúdo da bagagem. <br><br>

                    Identifique e rastreie sua bagagem - em proveria com a Trace me UK , de um lado da nossa tag terá um rastreador da bagagem e do outro lado da tag uma imagem de sua escolha . O quem em caso de extravio da bagagem , nossa tag de identificação poder servir de referência para localização e devolução ao seu dono .
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section><!-- End F.A.Q Section -->

    <!-- ======= Testimonials Section ======= -->
    <!-- <section id="testimonials" class="testimonials">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Testemunhos</h2>
          <p>O que os clientes estão dizendo</p>
        </header>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                </p>
                <div class="profile mt-auto">
                  <img src="<?=base_url(); ?>assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                  <h3>Saul Goodman</h3>
                  <h4>Ceo &amp; Founder</h4>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                </p>
                <div class="profile mt-auto">
                  <img src="<?=base_url(); ?>assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                  <h3>Sara Wilsson</h3>
                  <h4>Designer</h4>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                </p>
                <div class="profile mt-auto">
                  <img src="<?=base_url(); ?>assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                  <h3>Jena Karlis</h3>
                  <h4>Store Owner</h4>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                </p>
                <div class="profile mt-auto">
                  <img src="<?=base_url(); ?>assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                  <h3>Matt Brandon</h3>
                  <h4>Freelancer</h4>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                </p>
                <div class="profile mt-auto">
                  <img src="<?=base_url(); ?>assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                  <h3>John Larson</h3>
                  <h4>Entrepreneur</h4>
                </div>
              </div>
            </div>

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section> -->
    <!-- End Testimonials Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Contato</h2>
          <p>Fale com a gente</p>
        </header>

        <div class="row gy-4" style="text-align: center;">

          <div class="col-lg-12">
            <div class="content">
              <p>Tire suas dúvidas e escolha a melhor proteção para a sua bagagem. <br>
                 Saiba como iremos te ajudar em tudo que se relacionar a sua bagagem. <br>
                 Com simples prevenção você diminuirá muito a chance de passar pela frustração de ter sua bagagem extraviada em definitivo. Caso isso ocorra, oferecemos toda informação necessária para que sua bagagem seja localizada e devolvida.
              </p><br><br>
              <a href="https://api.whatsapp.com/send?phone=447490749774&text=Gostaria de informações sobre o MyThreePi" class="wt_btn">FALE CONOSCO! <img src="<?=base_url(); ?>assets/img/whats_btn.png" class="img-fluid wt_img" alt=""></a>
            </div>
          </div>

        </div>
      </div>

    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>TAG</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/TAG-bootstrap-startup-template/ -->
        Designed by Andre Kehrer</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?=base_url(); ?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?=base_url(); ?>assets/vendor/aos/aos.js"></script>
  <script src="<?=base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url(); ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?=base_url(); ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?=base_url(); ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?=base_url(); ?>assets/vendor/php-email-form/validate.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?=base_url(); ?>assets/js/main.js"></script>
  <script>

        function add_carrinho(elem) {
            var site_url = "<?=base_url()?>";
            var id =  $(elem).attr("data-id");
            var nome =  $(elem).attr("data-nome");
            var preco =  $(elem).attr("data-preco");
            $.ajax({
                type: "POST",
                url: site_url + "add_carrinho",
                data: "id=" + id + "&nome=" + nome + "&preco=" + preco,
                success: function(response) {
                    var jsonData = JSON.parse(response);
                    console.log(jsonData);
                    $('#qtd_cart').show().html(jsonData);
                    $('#prod_'+id).show();
                    setTimeout(function() { 
                        $('#prod_'+id).hide('slow');
                    }, 2000);
                }
            });
        }
    </script>

</body>

</html>