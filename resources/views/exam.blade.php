@extends('layouts.ui')
@section('main')
    <div class="container my-5 px-4 text-medium">
      <div class="row">
        <div class="col-sm-4 bg-dark mb-3 d-flex py-2">
          <div id="timer" class="text-white"></div>
          <button class="btn btn-success btn-sm ms-3" id="button">Start</button>
          <button class="btn btn-success btn-sm ms-3" data-bs-toggle="modal" data-bs-target="#result">Check Hasil</button>
        </div>
        <div class="col-sm-8 mb-3 number">
          @for ($i = 0; $i < $slug->quantity; $i++)   
          <a href="#" class="badge bg-warning text-decoration-none" id="{{$i}}">{{$i+1}}</a>
          @endfor
        </div>
      </div>
      <div class="row">
        <div class="bg-secondary div.col-md-10">
          <div id="panel" class="mb-2"></div>
          <div id="option"></div>
        </div>
      </div>
      <div class="row explanation d-none">
        <div class="col-md-10">
          <div id="explaination"></div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="result" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="resultLabel">Hasil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul id="showResult" class="list-group">
              
            </ul>
            <p>Tekan tombol dua kali untuk menampilkan hasil terbaru</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="buttonResult">Tampilkan nilai</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" id="pomodoro" data-bs-target="#pomodoroModal">
      Launch static backdrop modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="pomodoroModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Sesi Istirahat</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Wah, kamu sudah belajar sangat keras. Yuk istirahat dulu, lalu lanjut belajar lagi ^v^
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      // timer
      const button = document.getElementById('button');
      let timer = document.getElementById('timer');
      const begin = () => {
                let pole = new Date().getTime();
                const start = setInterval( () => {
                        var now = new Date().getTime();
                        var time = now - pole;
                            
                        var hours = Math.floor((time % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((time % (1000 * 60)) / 1000);
                        if (button.innerText == 'Start') {
                          clearInterval(start);
                          timer.innerHTML = `0 jam 0 menit 0 detik`
                          exit
                        }
                        if (time == 1000*60.25 || time == 1000*60.55 || time == 1000*60.85 || time == 1000*60.115) {
                          document.getElementById("pomodoro").click();
                        }
                        timer.innerHTML = `${hours} jam ${minutes} menit ${seconds} detik`;
                        }, 1000);
            }
      button.addEventListener('click', (e) => {
        if (e.target.innerText == 'Start') {
            e.target.innerText = 'Reset';
            e.target.classList.remove('btn-success');
            e.target.classList.add('btn-danger');
            begin();
          } else {
            e.target.innerText = 'Start';
            e.target.classList.add('btn-success');
            e.target.classList.remove('btn-danger');
          }
      }
      );
      // soal
      const number = document.querySelector('.number');
      const panel = document.querySelector('#panel');
      const option = document.querySelector('#option');
      const explaination = document.querySelector('#explaination');
      let questions = [];
      fetch('/features/fetchquestion/' + {{$slug->id}})
        .then(response => response.json())
        .then(response => {
          questions = response.concat();
      });
      number.addEventListener('click', (e) => {
        let no = e.target.id;
        panel.innerText = questions[no].question;
        explaination.innerHTML = `<b>Jawaban : ${questions[no].key}</b><br>` + questions[no].explanation;
        option.innerHTML = getOption(questions[no], no);
        let answer = document.querySelector('.form-check-input');
    // css nomor
        for (let index = 0; index < questions.length; index++) {
          if (getCookie("nomor"+index)) {
              let add = document.getElementById(index).classList.add("bg-success");
              let remove = document.getElementById(index).classList.remove("bg-warning");
          }
        }
    });
        const key = ['a', 'b', 'c', 'd', 'e'];
        option.addEventListener('click', (e) => {
          if(key.includes(e.target.value)) {
            setCookie(e.target.name, e.target.value, "{{$slug->slug}}");
          }
          console.log(document.cookie);
        });
    // cookies    
    function setCookie(name,value, slug) {
      document.cookie = name + "=" + value + ";expire=; path=/features/exam/" + slug + ";";
    }
    function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    }
    // cek hasil
    let benar, salah, kosong;
    const btnResult = document.getElementById("buttonResult");
    const showResult = document.getElementById("showResult");
    const result = document.getElementById("result");
    const explanationClass = document.querySelector(".explanation");
    result.addEventListener("click", () => {
      benar = 0; salah = 0; kosong = 0;
      for (let index = 0; index < questions.length; index++) {
        if (getCookie("nomor"+index) == questions[index].key) {
          benar +=1;
        } else if (!key.includes(getCookie("nomor"+index))) {
          kosong += 1;
        } else {
          salah += 1;
        }
      }
      btnResult.addEventListener("click", () => {
        showResult.innerHTML = `<li class="list-group-item text-success">Benar : ${benar}</li><li class="list-group-item text-danger">salah : ${salah}</li><li class="list-group-item">kosong : ${kosong}</li>`;
        explanationClass.classList.remove("d-none");
        console.log(questions, benar, salah, kosong);
      });
    });
    function getOption(option, no) {
      return `<div class="form-check">
                <input class="form-check-input" type="radio" name="nomor${no}" id="opt_a" value="a" ${getCookie("nomor"+no) == "a"? "checked":""}>
                <label class="form-check-label" for="opt_a">${option.opt_a}</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="nomor${no}" id="opt_b" value="b" ${getCookie("nomor"+no) == "b"? "checked":""}>
                <label class="form-check-label" for="opt_b">${option.opt_b}</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="nomor${no}" id="opt_c" value="c" ${getCookie("nomor"+no) == "c"? "checked":""}>
                <label class="form-check-label" for="opt_c">${option.opt_c}</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="nomor${no}" id="opt_d" value="d" ${getCookie("nomor"+no) == "d"? "checked":""}>
                <label class="form-check-label" for="opt_d">${option.opt_d}</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="nomor${no}" id="opt_e" value="e" ${getCookie("nomor"+no) == "e"? "checked":""}>
                <label class="form-check-label" for="opt_e">${option.opt_e}</label>
              </div>"`;
    }
    </script>
@endsection