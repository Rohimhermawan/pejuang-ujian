@extends('layouts.ui')
@section('main')
            <div class="container-fluid p-0" style="height: 500px; background-image: url(/img/berkas/main.png);">
                <div class="w-100 h-100 d-flex align-items-center text-white" style="background-color: rgba(0, 0, 0, 0.747);">
                    <div class="container text-center">
                        <h1 class="">Welcome Warrior!</h1>
                        <h4 class=""></h4>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row my-5">
                    <div class="col-md-4 d-flex text-white align-items-center" style="background-color: rgb(2, 39, 73)" data-aos="zoom-in">
                        <div class="text-center">
                            <h2>Our Feature</h2>
                            <p class="">Fitur yang kami sediakan berguna untuk kalian yang ingin menambah pengetahuan dalam bidang-bidang tertentu yang ingin kalian kuasai</p>
                        </div> 
                    </div>
                    <div class="col-md-8">
                        <div class="row justify-content-evenly" data-aos="fade-left" data-aos-offset="400" data-aos-duration="1200">
                            <div class="col-md-9">
                                <img src="/img/berkas/blog.png" class="img-fluid">    
                            </div>
                            <div class="col-md-3 d-flex ms-auto justify-content-center align-items-center">
                                <div class="text-center">
                                    <h4 class="text-dark">Blog</h4>
                                    <a href="/features?category=post" class="btn" style="background-color: #E3BEC6">See more</a>
                                </div>
                            </div>
                        </div>
                        <div class="row flex-sm-row-reverse" data-aos="fade-right" data-aos-offset="400" data-aos-duration="1200">
                            <div class="col-md-9">
                                <img src="/img/berkas/soal.png" alt="" class="img-fluid">    
                            </div>
                            <div class="col-md-3 d-flex ms-auto justify-content-center align-items-center">
                                <div class="text-center">
                                    <h4 class="text-dark">Soal-Soal</h4>
                                    <a href="/features?category=exam" class="btn" style="background-color: #E3BEC6">See more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
            <script>
                AOS.init({
                        once:true
                        });
            </script>
@endsection
