    @extends('layouts.app')

    @section('title', 'صفحه اصلی!')

    @section('content')
        <div style="margin-top:-20px;">
             <img src="/uploads/images/azmoon_banner.jpg" alt="" class="img-responsive"> 
        </div>

    <div class="container">
        <div class="container-fluid">
            <div class="row">

                <div class="newsbar col-sm-4 text-center hidden-sm hidden-xs hidden-md"><img src="/uploads/images/lead_note.jpg" alt="" class="img-responsive img-rounded" style="margin-bottom:10px;"></div>
                <div class="newsbar col-sm-4  text-center hidden-lg "><img src="/uploads/images/lead_note_16.jpg" alt="" class="img-responsive img-rounded " style="margin-bottom:10px;"></div>
                <div class="newsbar col-sm-8">
                    <div class="panel panel-primary">
              <div class="panel-heading color1">کلام رهبری</div>
              <div class="panel-body">
              <p style="padding-top:20px;">به نظر ما در حوزه‌های علمیه بایستی اهداف جداگانه‌ای را مورد توجه قرار داد. یك هدف، ساختن مجتهد فقیه متخصص فنی، باید فقهائی باشند و مجتهدینی باشند؛ این یك هدف، افرادی با استعدادهایی در حدّ خاص، و با شوق و علاقه بایستی بروند طرف اینجور درس خواندن و به سمت آن رفت. در كنار اینها كسانی باشند كه قدرت استنباط پیدا كنند و بتوانند از منابع اسلامی معارف الهی را به دست بیاورند، اما نه به قصد اِفتاء. نه به قصد این‌كه در فقه یك انسان متبحر متخصص در فقه بشوند، نه! به قصد این‌كه بتوانند معارف اسلامی را كه بحثهای فراوان و كتابهای فراوان و مباحث لازم برای به خصوص جامعه‌ی امروز ما در آنها هست اینها را استخراج بكنند و دراختیار مردم بگذارند، در اختیار نظام بگذارند. و ما امروز چقدر احتیاج داریم به اینجور استنباطها. در حقیقت مجتهدین درجه‌ی دو كه اینها اگر چه از لحاظ عمق فقهی و درسی درجه‌ی دو هستند اما ممكن است از لحاظ سعه‌ی نظر و مُتِحَنِّن بودن از آن دسته‌ی اوّل حتی قویتر و بالاتر و همه‌جانبه‌تر باشند.</p>
              </div>
              <div class="panel-footer text-left">
                    ۱۳۶۴/۰۹/۲۶  -- 
                    بیانات در مراسم سالگرد شهادت دکتر مفتح

                </div>
            </div>
                </div>
            
            
                <div class="newsbar col-sm-12 ">
                <div class="panel panel-primary">
                <div class="panel-heading color1">آشنایی بیشتر با  مدارس و مراکز شرکت کننده در آزمون جامع</div>
                <div class="panel-body">
                  <a href="http://alfegh.ir/" class="btn btn-primary btn-block">مدرسه فقهی آل یاسین</a>
                  <a href="https://www.saheb-e-amr.ir/" class="btn btn-success btn-block">مدرسه علمیه حضرت صاحب الامر (عج)</a>
                  <a href="http://qaim.ir/" class="btn btn-danger btn-block">مرکز فقهی قائم (عج)</a>
                  <a href="http://ansarolmahdi.net/" class="btn btn-info btn-block">موسسه فقهی و اصولی کریم اهل بیت (ع)</a>
                    
                    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">
  مدرسه امام کاظم (ع)
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">اطلاعات مدرسه</h4>
      </div>
      <div class="modal-body">
        موسسین : آیت االه بوشهری -حاج اقا لولاچیان - حسین یوسفی <br />
 وابسته به جمعیت تعاون اسلامی<br />
مسئول پذیرش: حجت الاسلام سید احمد محمدی
<br />تلفن: 02537749182
<br />09194858196
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
      </div>
    </div>
  </div>
</div>
                 
         <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#myModal2" style="margin-top:5px;">
مدرسه تخصصی حضرت امام حسن عسکری (ع)
</button>         
                  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">اطلاعات مدرسه</h4>
      </div>
      <div class="modal-body">
        موسس :حجت الاسلام سید امین جوادی <br />
        سال تأسیس : 1391  <br />
        مدیر مدرسه : حجت الاسلام کاظم سپاسی<br />
         مسئول پذیرش : عسکری  <br />
          تلفن تماس : 32933844-025 <br />
           آدرس : بلوار امین نبش کوچه 25
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
      </div>
    </div>
  </div>
</div>
                   
                   
                    </div>  
                    <div class="panel-footer text-left">
                        برای اطلاعات و راهنمایی بیشتر با تلفن 02532617367 تماس حاصل نمایید.
                    </div>
                </div>
                   </div>
            
            
                <div class="newsbar col-sm-8">
                    <div class="panel panel-primary">
              <div class="panel-heading color1"> منابع آزمون و نمونه سؤال </div>
              <div class="panel-body">
              <p style="padding-top:40px;">
                <ol>
                    <li>شرح لمعه</li>
                    <li>اصول فقه</li>
                    <li>ادبیات عرب</li>
                    <li>هوش</li>
                </ol>
               </p>
                <div class="panel panel-info">
                        <div class="panel-heading"><i class="fa fa-file-pdf-o"></i> دریافت <a href="/uploads/files/exam.pdf"><strong>نمونه سؤال آزمون</strong></a></div>
                        <div class="panel-heading"><i class="fa fa-file-pdf-o"></i> دریافت  <a href="/uploads/files/{{ $options->get('instructions')->value }}"><strong>منابع آزمون</strong></a></div>
                          </div>
              </div>
               
               
            </div>
                </div>
                 <div class="newsbar col-sm-4 text-center hidden-sm hidden-xs hidden-md"><img src="/uploads/images/manabe_azmoon.jpg" alt="" class="img-responsive img-rounded" style="margin-bottom:10px;"></div>
                <div class="newsbar col-sm-4  text-center hidden-lg "><img src="/uploads/images/manabe_azmoon_16.jpg" alt="" class="img-responsive img-rounded " style="margin-bottom:10px;"></div>
            
            
            
            </div>
           

            </div>
        </div>
    @endsection
