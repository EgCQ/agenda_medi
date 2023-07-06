
var table = document.getElementById('table');
var num_hora = document.getElementById('num_hora');

var table2 = document.getElementById('semana');
var dias1 = document.getElementById('dias');
var horario = document.getElementById('horario');
dias1.classList.add('bg-dark');
var dias = ['Lunes','Martes','Miercoles','Jueves','Viernes'];
for (let i3 = 0; i3 < 12; i3++) {
    var div4 = document.createElement('div');
    var div5 = document.createElement('div');

    var p = document.createElement('p');
    var p2 = document.createElement('p');
    var p3 = document.createElement('p');

    num_hora.append(div4);
    div4.append(div5);
    div5.append(p);

    div5.append(p2);
    div5.append(p3);
    num_hora.style.border = "1px solid gray";

    div5.classList.add('d-flex', 'text-center');
    num_hora.style.width  ="fit-content";
    num_hora.classList.add('text-center');

    div4.style.width = "100%";
    div5.style.paddingLeft = "0.5rem";
    div5.style.paddingRight = "0.5rem";

    div5.style.height = "25px";
    var para1 = "0"+(i3+7)+":00";
    var para = "-";

    var para2 = "0"+(i3+8)+":00";
    var para1_0 = (i3+7)+":00";
    var para2_0 = (i3+8)+":00";

    p.innerHTML = para1;
    p2.innerHTML = para;

    p3.innerHTML = para2;
    p.setAttribute('id', i3);

    p.style.margin = "0px";
    p2.style.margin = "0px";
    p2.classList.add('px-1');

    p3.style.margin = "0px";
    if (p.id == 2){
        p.innerHTML = para1;

        p3.innerHTML = para2_0;

    }
    if (p.id >= 3){
        p.innerHTML = para1_0;
        p3.innerHTML = para2_0;    }
}
for (let i = 0; i < dias.length; i++) {
    const element = dias[i];
    console.log(element);
    const tables3 = dias1[i];

    var h5 = document.createElement('h5');
    var div = document.createElement('div');
    var div2 = document.createElement('div');

    h5.append(element);

    dias1.append(div2);

    div2.append(h5);
    div2.classList.add('w-100', 'text-center');
    h5.classList.add('p-1', 'm-0', 'text-white');
    horario.append(div);
    horario.classList.add('d-flex','w-100', 'bg-white', 'flex-row');
    div.setAttribute('id', element);
    // horario.classList.add('flex-column');

    for (let i2 = 0; i2 < 12; i2++) {
        var div3 = document.createElement('div');

        var checkbox = document.createElement('input');
        var label = document.createElement('label');
        checkbox.setAttribute('type', 'radio');
        checkbox.setAttribute('id', 'checkbox'+(i2+1)+element+'[]');
        checkbox.setAttribute('name', 'checkbox'+element);
        checkbox.style.opacity = "0";
        checkbox.style.width = "0px";
        checkbox.style.height = "0px";
        checkbox.value = (i2+7);
        if (checkbox.value <= 9) {
            checkbox.value = "0"+(i2+7)+":00";
        }
        if (checkbox.value > 9) {
            checkbox.value = (i2+7)+":00";
        }
        label.setAttribute('for', 'checkbox'+(i2+1)+element+'[]');
        label.setAttribute('name', 'label'+(i2+1)+element+'[]');

        div.append(div3);

        div3.append(checkbox);
        div3.append(label);
        div.style.border = "1px solid gray";

        div3.setAttribute('id', "hora"+(i2+1));
        div.classList.add('d-flex', 'flex-column', 'w-100');
        div3.classList.add('d-flex', 'p-1', 'justify-content-center');
        div3.style.height = "25px";

        label.classList.add( 'text-center' );
        label.style.width = "50px";
    }


}
var tyoe = document.getElementsByTagName("input");
var label = document.getElementsByTagName("label");

for (let index = 0; index < tyoe.length; index++) {
    const element = tyoe[index];

    const element2 = label[index-1];

        element.addEventListener('click', function (event) {
                console.log(element.id+" checked");
        });

}

// for (let index2 = 0; index2 < label.length; index2++) {
//     const element2 = label[index2];
//     element2.addEventListener('click', function () {
//         console.log(element2.getAttribute('name'));
//         element2.style.backgroundColor = "red";
//     });
// }
