function generatepdf(){
    const element=document.getElementById("pdf");
    var opt = {
        margin:       4.5,
        filename:     'receipt.pdf',
        image:        { type: 'jpeg', quality: 1},
        html2canvas:  { scale: 10 },
        jsPDF:        { unit: 'cm', format: 'a4', orientation: 'portrait' }
      };

    html2pdf()
    .set(opt)
    .from(element)
    .save();
}

// function generatepdf() {
//     const element = document.getElementById("pdf");
//     const opt = {
//         margin:       4,
//         filename:     'receipt.pdf',
//         image:        { type: 'jpeg', quality: 0.98 },
//         html2canvas:  { scale: 2 },
//         jsPDF:        { unit: 'cm', format: 'a4', orientation: 'portrait' }
//     };

//     // Generate the PDF and open it in a new window
//     html2pdf().from(element).set(opt).outputPdf().then(pdf => {
//         const blob = new Blob([pdf], { type: 'application/pdf' });
//         const url = URL.createObjectURL(blob);
//         const newWindow = window.open(url, '_blank');
//     });
// }