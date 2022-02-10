const tittle = document.getElementById('tittle');
  const slug = document.getElementById('slug');

  tittle.addEventListener('change', function() {
    fetch('/admin/post/createSlug?tittle=' + tittle.value)
      .then(response => response.json())
      .then(data => slug.value = data.slug)
  });

  const body = document.getElementById("body");
     CKEDITOR.replace(body,{
     language:'en-gb'
   });
   CKEDITOR.config.allowedContent = true;

   function imagePreview() {
     const img = document.querySelector('#image');
     const imgPrev = document.querySelector('.image-preview');

    imgPrev.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(img.files[0]);
    oFReader.onload = oFREvent => imgPrev.src = oFREvent.target.result;
   }