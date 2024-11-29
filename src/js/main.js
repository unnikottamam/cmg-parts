import { Modal } from "bootstrap";

document.addEventListener("DOMContentLoaded", (event) => {
  let googleactive = 0;
  document.querySelectorAll("form *").forEach(function (element) {
    element.addEventListener("focus", function () {
      if (googleactive === 0) {
        const head = document.getElementsByTagName("head")[0];
        const script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "https://www.google.com/recaptcha/api.js?render=6Lfq70EhAAAAAHamq45EaFenkNmCbySLtfyqSpoT";
        head.appendChild(script);
        document.querySelector(".formcurrency").value =
            document.querySelector(".head__currency[selected]").dataset.currency;
      }
      googleactive++;
    });
  });

  const submitBtns = document.querySelectorAll(".form_submit");
  submitBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      let form = null;
      if (btn.previousElementSibling && btn.previousElementSibling.tagName.toLowerCase() === 'form') {
        form = btn.previousElementSibling;
      } else {
        const parentEle = btn.parentNode;
        form = parentEle.previousElementSibling.querySelector('form');
      }
      
      let isValid = true;
      if (form) {
        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(field => {
          if (!field.checkValidity()) {
            field.classList.add('border-danger', 'border-1', 'bg-danger-subtle');
            isValid = false;
          } else {
            field.classList.remove('border-danger', 'border-1', 'bg-danger-subtle');
          }
        });
        const errorEle = form.querySelector('.error_ele');
        const outputElement = form.querySelector(".error_form");
        if (!isValid) {
          errorEle.classList.remove('d-none');
          outputElement.innerHTML = "Please fill all Required Fields (*)";
          outputElement.scrollIntoView({
            behavior: "smooth",
            block: "end"
          });
        } else {
          errorEle.classList.add('d-none');
          grecaptcha.ready(function () {
            grecaptcha
              .execute("6Lfq70EhAAAAAHamq45EaFenkNmCbySLtfyqSpoT", {
                action: "submit",
              })
              .then(function (token) {
                form.querySelector(".captcha_res").value = token;
                const formUrl = form.getAttribute("action");
                const formData = new FormData(form);
                fetch(formUrl, {
                  method: "POST",
                  body: formData,
                })
                  .then(response => response.json())
                  .then(function (data) {
                    errorEle.classList.remove("d-none");
                    outputElement.innerHTML = data.message;
                    outputElement.scrollIntoView({
                      behavior: "smooth",
                      block: "end"
                    });
                    if (data.status === "success") {
                      outputElement.classList.remove("text-danger", "bg-danger-subtle");
                      outputElement.classList.add("text-success", "bg-success-subtle")
                      form.reset();
                      setTimeout(function () {
                        errorEle.classList.add("d-none");
                      }, 5000);
                    }
                  });
              });
          });
        }
      }
    });
  });
  
  Array.from(document.querySelectorAll(".toast")).forEach(
    (toastNode) => new Toast(toastNode)
  );

  const catModal = document.getElementById("categoryModal");
  catModal.addEventListener("show.bs.modal", (event) => {
    const btn = event.relatedTarget;
    if (btn.dataset.cat) {
      const targetTab = document.querySelector(
        `[data-bs-target="#${btn.dataset.cat}"]`
      );
      targetTab.click();
    }
  });

  const cardElements = document.querySelectorAll(".prod__grids .card");
  cardElements.forEach((cardElement) => {
    const dataSrc = cardElement.getAttribute("data-src");
    if (dataSrc) {
      const imgElement = document.createElement("img");
      imgElement.src = dataSrc;
      imgElement.classList.add("position-absolute", "bottom-0");
      const imgEle = cardElement.querySelector(".card__img");
      imgEle.appendChild(imgElement);
    }
  });

  const noticeModal = document.getElementById("noticeModal");
  if (noticeModal) {
    setTimeout(() => {
      const modalInstance = new Modal(noticeModal);
      modalInstance.show();
    }, 3000);
  }
});