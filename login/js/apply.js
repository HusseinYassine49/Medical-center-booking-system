const cvInput = document.getElementById('cv-upload');
const cvNameDisplay = document.querySelector('.file-name');
const cvLabel = document.querySelector('.custom-file-upload');

cvInput.addEventListener('change', function() {
    if (this.files.length > 0) {
        cvNameDisplay.textContent = this.files[0].name;
        cvLabel.classList.add('selected');
        cvLabel.textContent = "File Selected";
    } else {
        cvNameDisplay.textContent = "No file chosen";
        cvLabel.classList.remove('selected');
        cvLabel.textContent = "Choose File";
    }
});

const photoInput = document.getElementById('photo-upload');
const photoNameDisplay = document.querySelector('.photo-name');
const photoLabel = document.querySelector('.custom-photo-upload');

photoInput.addEventListener('change', function() {
    if (this.files.length > 0) {
        photoNameDisplay.textContent = this.files[0].name;
        photoLabel.classList.add('selected');
        photoLabel.textContent = "Photo Selected";
    } else {
        photoNameDisplay.textContent = "No photo chosen";
        photoLabel.classList.remove('selected');
        photoLabel.textContent = "Choose Photo";
    }
});




        

        var x, i, j, l, ll, selElmnt, a, b, c;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName("custom-select");
        l = x.length;
        for (i = 0; i < l; i++) {
          selElmnt = x[i].getElementsByTagName("select")[0];
          ll = selElmnt.length;
          /*for each element, create a new DIV that will act as the selected item:*/
          a = document.createElement("DIV");
          a.setAttribute("class", "select-selected");
          a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
          x[i].appendChild(a);
          /*for each element, create a new DIV that will contain the option list:*/
          b = document.createElement("DIV");
          b.setAttribute("class", "select-items select-hide");
        
          // Loop through options and create DIV elements for them
          for (j = 0; j < ll; j++) {
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
              /*when an item is clicked, update the original select box,
              and the selected item:*/
              var y, i, k, s, h, sl, yl;
              s = this.parentNode.parentNode.getElementsByTagName("select")[0];
              sl = s.length;
              h = this.parentNode.previousSibling;
              for (i = 0; i < sl; i++) {
                if (s.options[i].innerHTML == this.innerHTML) {
                  s.selectedIndex = i;
                  h.innerHTML = this.innerHTML;
                  y = this.parentNode.getElementsByClassName("same-as-selected");
                  yl = y.length;
                  for (k = 0; k < yl; k++) {
                    y[k].removeAttribute("class");
                  }
                  this.setAttribute("class", "same-as-selected");
                  break;
                }
              }
              h.click();
            });
            if (selElmnt.options[j].disabled) {
              c.setAttribute("disabled", "disabled");
            }
            b.appendChild(c);
          }
          x[i].appendChild(b);
          a.addEventListener("click", function(e) {
            /*when the select box is clicked, close any other select boxes,
            and open/close the current select box:*/
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
          });
        }
        function closeAllSelect(elmnt) {
          /*a function that will close all select boxes in the document,
          except the current select box:*/
          var x, y, i, xl, yl, arrNo = [];
          x = document.getElementsByClassName("select-items");
          y = document.getElementsByClassName("select-selected");
          xl = x.length;
          yl = y.length;
          for (i = 0; i < yl; i++) {
            if (elmnt == y[i]) {
              arrNo.push(i)
            } else {
              y[i].classList.remove("select-arrow-active");
            }
          }
          for (i = 0; i < xl; i++) {
            if (arrNo.indexOf(i)) {
              x[i].classList.add("select-hide");
            }
          }
        }
        /*if the user clicks anywhere outside the select box,
        then close all select boxes:*/
        document.addEventListener("click", closeAllSelect);