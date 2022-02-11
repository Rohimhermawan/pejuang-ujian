let url = document.location.pathname, urlFetch;
let path = url.split("/")[2];

if (path == 'posts' || path == 'exams') {
     if (path == 'posts') {
          const body = document.getElementById("body");
               CKEDITOR.replace(body,{
               language:'en-gb'
             });
          CKEDITOR.config.allowedContent = true;
          urlFetch = '/admin/post/createSlug?tittle=';
     } else if (path == 'exams') {
          urlFetch = '/admin/exam/createSlug?tittle=';
     }
        
     const tittle = document.getElementById('tittle');
     const slug = document.getElementById('slug');
     
     tittle.addEventListener('change', function() {
       fetch( urlFetch + tittle.value)
       .then(response => response.json())
       .then(data => slug.value = data.slug)
     });
}

     
function imagePreview() {
const img = document.querySelector('#image');
const imgPrev = document.querySelector('.image-preview');

imgPrev.style.display = 'block';

const oFReader = new FileReader();
oFReader.readAsDataURL(img.files[0]);
oFReader.onload = oFREvent => imgPrev.src = oFREvent.target.result;
}