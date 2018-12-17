/*

Main file to handling the request response of apis



*/



import { Injectable } from '@angular/core';
//import { ConstantsProvider } from "../../providers/constants/constants"
import { Http, Headers, RequestOptions } from '@angular/http';
import 'rxjs/add/operator/catch';
import 'rxjs/add/operator/toPromise';
import 'rxjs/add/operator/map';



@Injectable()
export class AngularHttpProvider {
 // API_URL = 'http://localhost/sprs/apis/';
  API_URL = 'http://18.219.41.25/sprs/apis/';
  public loading = false;
  headers = new Headers(
    {
      'Content-Type': 'application/json',
      'app_token':localStorage.getItem('token')
    });
  server_response : string;
  options = new RequestOptions({ headers: this.headers });


  headers1 = new Headers(
    {
      //'Content-Type': 'application/x-www-from-urlencoded',
      'Content-Type': 'multipart/form-data',
      'app_token':localStorage.getItem('token')
    });

  options1 = new RequestOptions({ headers: this.headers1 });

  constructor(public http: Http) { //,public constant: ConstantsProvider
    console.log('Hello AngularHttpProvider Provider');
  }

  post(url,body){

     // alert(JSON.stringify(body));
       body.timezone = localStorage.getItem('TimeZone');
      return this.http.post(this.API_URL+url,JSON.stringify(body), this.options);
       
       
  }
  post_image(url,body){

     alert(JSON.stringify(body));
   
     return this.http.post(this.API_URL+url,JSON.stringify(body),this.options1);
      
      
 }

  get(url){
    return this.http.get(this.API_URL+url, this.options);
      
    // return this.http.get(this.constant.API_URL+url, this.options).map((res)=>{
    //   this.server_response = JSON.stringify(res.json());
    //   console.log(res);
    // },(err)=>{
    //   this.server_response = err._body;
    //   console.log(err);
    // });
  }

  put(url,body){
      return this.http.put(url,body, this.options)
        .toPromise()
        .then((response) =>
        {
          this.server_response = JSON.stringify(response.json());
        })
        .catch((error) =>
        {
          this.server_response = error._body;
        });
  }

  delete(url){
      return this.http.delete(url, this.options)
      .toPromise()
      .then((response) =>
      {
        this.server_response = JSON.stringify(response.json());
      })
      .catch((error) =>
      {
        this.server_response = error._body;
      });
  }

}
