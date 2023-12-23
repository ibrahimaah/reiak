
  <!-- Footer -->
  <footer
          class="text-center mt-5 text-lg-start bg-light"
          style="box-shadow: 0px -8px 16px rgba(0, 0, 0, 0.15);"
    >
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <h5 class="mb-4 font-weight-bold text-center text-success">
              وش رايك
            </h5>
            <p class="text-secondary text-justify text-end" style="font-size: 16px;">
            منصة رقمية عربية، الأولى من نوعها التي تهدف إلى استكشاف "ما يفكر فيه الناس" في المملكة العربية السعودية في مجالات متعددة، 
            وقد تم إنشاؤها بواسطة فريق عمل سعودي كامل لتواكب رؤية2030 لعمل لتحسين المنتجات والخدمات المقدمة للمواطن والمقيم والزائر لوطننا الغالي .
            </p>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3 text-end text-center">
            <h5 class="mb-4 font-weight-bold text-center text-success">
              الصفحات 
            </h5>
            <p>
              <a href="{{ route('platform.index') }}" class="text-secondary"> القائمة الرئيسية </a>
            </p>
            @auth
            <p>
              <a href="{{ route('vote.create') }}" class="text-secondary"> اضافة موضوع </a>
            </p>
            @endauth
            <p>
              <a href="#!" class="text-secondary"> دليلك </a>
            </p>
            <p>
              <a href="#!" class="text-secondary"> دعوة اصدقاء </a>
            </p>
            <p>
              <a href="{{ route('platform.about') }}"  class="text-secondary"> من نحن </a>
            </p>
            <p>
              <a href="#" class="text-secondary"> سياسة الخصوصية </a>
            </p>
            <p>
              <a href="#" class="text-secondary"> مساعدة </a>
            </p>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <!-- <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3 text-end text-center">
            <h5 class="mb-4 font-weight-bold text-center text-success">
              روابط مهمة 
            </h5>
            
          </div> -->

           <!-- Grid column -->
           <!-- <hr class="w-100 clearfix d-md-none" /> -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3 text-end text-center">
            <h5 class="mb-4 font-weight-bold text-center text-success" id='contact'>
              تواصل معنا
            </h5>

            <div class="d-flex flex-column gap-2">
              <div>
                <span><i class="fa fa-home text-secondary" style="font-size:1.4rem"></i></span>
                <span class="text-secondary" style="font-size:0.8rem">الدمام - المملكة العربية السعودية</span> 
              </div>
              <div>
                <span><i class="fa fa-envelope text-secondary"></i></span>
                <span class="text-secondary" style="font-size:0.8rem">Infofo@reaik.com</span> 
              </div>
              
              <div>
                <span><i class="fa fa-phone text-secondary" style="font-size:1.2rem"></i></span>
                <span class="text-secondary" style="font-size:0.8rem">+966546500781</span>                 
              </div>
            </div>
          </div>

         

          <!-- Grid column -->
         
          <!-- Grid column -->
        </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->

      <hr class="my-3">

      <!-- Section: Copyright -->
      <section class="p-3 pt-0 bglight">
        <div class="row d-flex align-items-center">
          <!-- Grid column -->
          <div class="col-md-7 col-lg-8 text-center text-md-end">
            <!-- Copyright -->
            <div class="p-3">
              © <?=date("Y")?> Copyright:
              <a class="text-success" href="https://reiak.com/"
                 >reiak.com</a
                >
            </div>
            <!-- Copyright -->
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-start">
            <!-- Facebook -->
            <a
               href="#"
               class="fs-3 mx-3"
               role="button"
               ><i class="fa fa-facebook text-success"></i
              ></a>

            <!-- Twitter -->
            <a
               href="#"
               class="fs-3 mx-3"
               role="button"
               ><i class="fa fa-twitter text-success"></i
              ></a>


            <!-- Instagram -->
            <a
               href="#"
               class="fs-3 mx-3"
               role="button"
               ><i class="fa fa-instagram text-success"></i
              ></a>
          </div>
          <!-- Grid column -->
        </div>
      </section>
      <!-- Section: Copyright -->
    </div>
    <!-- Grid container -->
  </footer>
  <!-- Footer -->
