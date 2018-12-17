import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Http, Headers, Response, RequestOptions, RequestMethod } from '@angular/http';
@Injectable({
  providedIn: 'root'
})
export class APIService {
  //API_URL = 'http://localhost/sprs/apis';
  API_URL = 'http://18.219.41.25/sprs/apis/';
  constructor(private httpClient: HttpClient) { }

  getContacts() {
    return this.httpClient.get(`${this.API_URL}/contacts`);
  }


  loginPatient(contact) {

    alert(JSON.stringify(contact));
    console.log(contact);
    let headers = new HttpHeaders({
      'Content-Type': 'application/json'
    });
    const option = { headers: { 'Content-Type': 'application/json' } };

    
   // let options1 = { headers: headers };

//     const headers2 = new Headers(
//       {
//           'Content-Type': 'application/json'
//       });
//       const myheader = new HttpHeaders().set('Content-Type', 'application/json');
//       let headers = new Headers({ 'Content-Type': 'application/json' });
//       headers.append('Accept', 'application/json');
//       let optionsas = new RequestOptions({ headers: headers });

//       let httpHeaders = new HttpHeaders({
//         'Content-Type' : 'application/json',
//         'Cache-Control': 'no-cache'
//    }); 
//    let options = {
//     headers: httpHeaders
// };
//headers.append('Accept', 'application/json');

   return this.httpClient.post(this.API_URL + '/patientLogin.json',JSON.stringify(contact), option);
// alert(contact);
//    this.httpClient.post(this.API_URL + '/patientLogin.json',
//    {
//        "name": "Customer004",
//        "email": "customer004@email.com",
//        "tel": "0000252525"
//    })
//    .subscribe(
//        data => {
//            console.log("POST Request is successful ", data);
//        },
//        error => {
//            console.log("Error", error);
//        }
//    );   


  }
  loginPatienta() {
    // if (this.loginptForm.dirty && this.loginptForm.valid) {
    //   alert(`Username: ${this.loginptForm.value.username} password: ${this.loginptForm.value.password}`);
    //   if(this.loginptForm.value.username=='patient' && this.loginptForm.value.password=='patient'){
    //     this.HttpClientModule.post(`${this.API_URL}/contacts`)

    //     this.router.navigateByUrl('/readings/add')
    //   }

    // }
  }
}
