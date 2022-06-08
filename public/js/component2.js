
window.onload = function() {
    document.addEventListener('click', e => {
        if (e.target.matches('button.select-product')) {
            getProductByID(e.target.value);
        }
        if (e.target.matches('button.update-product')) {
            updateProductByID(e.target.value);
        }
        if (e.target.matches('button.delete-product')) {
            deleteProductByID(e.target.value);
        }
        if (e.target.matches('button.add-product')) {
            addNewProduct();
        }
    });
}

function  getProductByID(id) {
    window.location= "product/"+id;
}

async function updateProductByID(id) {
    var title = document.getElementById('title').value;
    var fname = document.getElementById('fname').value;
    var sname = document.getElementById('sname').value;
    var pages = document.getElementById('pages').value;
    var price = document.getElementById('price').value;


    //as sending the whole form up - this equates better to a put request
    try{
        const response = await axios.put('/product/'+id, {title:title, fname:fname, sname:sname, pages:pages, price:price});
        if(response.data.msg==='success') {
            console.log("success");
            window.location= "/product";
        }
        else console.error("some error");
    }
    catch (error) {
        console.error(error);
    }
}

async function deleteProductByID(id) {
    try{
        const response = await axios.delete('/product/'+id);
        if(response.data.msg==='success') {
            console.log("success");
            window.location= "/product"

        }
        else console.error("some error");
    }
    catch (error) {
        console.error(error);
    }
}

async function addNewProduct() {
    var producttype =  document.getElementById('producttype').value;
    var title = document.getElementById('title').value;
    var fname = document.getElementById('fname').value;
    var sname = document.getElementById('sname').value;
    var pages = document.getElementById('pages').value;
    var price = document.getElementById('price').value;

    if(!title ) title = " ";
    if(!fname ) fname = " ";
    if(!sname ) sname = " ";
    if(!pages) pages = 0;
    if(!price) price = 0;


    try{
        const response = await axios.post('/product/create',
            {producttype:producttype, title:title, fname:fname, sname:sname, pages:pages, price:price}
        );
        if(response.data.msg==='success') {
            console.log("success");
            location.reload();
        }
        else console.error("some error");
    }
    catch (error) {
        console.error(error);
    }
}
