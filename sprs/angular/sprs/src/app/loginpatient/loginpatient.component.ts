import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Router } from "@angular/router";
import { APIService } from '../api.service';
import { AngularHttpProvider } from '../angular-http';


@Component({
  selector: 'app-loginpatient',
  templateUrl: './loginpatient.component.html',
  styleUrls: ['./loginpatient.component.css']
})
export class LoginpatientComponent implements OnInit {

  private contacts: Array<object> = [];
  
  //constructor(private  apiService:  APIService) { }
  loginptForm: any;
  server_response: string;
  theHtmlString: string;
  loading = false;
  submitted = false;
  role_set:any;
  // API_URL  =  'http://localhost/sprs/apis/';
  constructor(private formBuilder: FormBuilder, private router: Router, private apiService: APIService, private angularHttp: AngularHttpProvider) {

    this.theHtmlString = "";
this.role_set='2';

    this.loginptForm = this.formBuilder.group({
      'username': ['', Validators.required],
      'password': ['', [Validators.required]],
      'remember_pt': [''],
       'role': ['']
      //'profile': ['', [Validators.required, Validators.minLength(10)]]
    });

    this.loginptForm.value.role='2';
   

  }
  
  submitLoginForm(){
    
  	if(this.loginptForm.value.role=='1'){ 
		this.loginDoctor();  	
  	}else if(this.loginptForm.value.role=='2'){
  		this.loginPatient();
  	}
  }
	
 forgotClick(){
 	if(this.loginptForm.value.role=='1'){
 		this.router.navigateByUrl('/drforgot'); 
 	}else if(this.loginptForm.value.role=='2'){
 		this.router.navigateByUrl('/Ptforgot');
 	}else{
 		this.theHtmlString="Please select role Doctor/Patient";
 	}
 }		
  loginPatient() {
    var contact = {
      username: this.loginptForm.value.username,
      password: this.loginptForm.value.password
    };

    let input = new FormData();
    // Add your values in here
    input.append('username', this.loginptForm.value.username);
    input.append('password', this.loginptForm.value.password);


    if (this.loginptForm.dirty && this.loginptForm.valid) {
      // alert(`Username: ${this.loginptForm.value.username} password: ${this.loginptForm.value.password}`);
      //if(this.loginptForm.value.username=='patient' && this.loginptForm.value.password=='patient'){
      //this.HttpClientModule.post(`${this.API_URL}/contacts`)
      //  this.apiService.loginPatient(contact).subscribe((response) => {

      //               console.log(response);
      //           });
      this.loading = true;
      this.angularHttp.post("patientLogin.json", contact)
        .toPromise()
        .then((response) => {
          this.server_response = JSON.stringify(response.json());
          var data = JSON.parse(this.server_response);
          //console.log(response.json());
          //console.log(data.status);
          if (data.status == 200) {

            
           
            this.loading = false;
            localStorage.setItem('isLoggedIn', "true");
            localStorage.setItem('token',data.data["patientinfo"]['app_token'] );
            localStorage.setItem('user_id',data.data["patientinfo"]['id'] );

            localStorage.setItem('profile_pic',data.data["patientinfo"]['profile_pic'] );
            localStorage.setItem('Dob',data.data["patientinfo"]['Dob'] );
            localStorage.setItem('name',data.data["patientinfo"]['first_name']+' '+data.data["patientinfo"]['last_name'] );


            this.router.navigateByUrl('/myprofile');

          } else {

            this.theHtmlString = data.message;
            this.loading = false;
            //alert(data.message);

          }


        })
        .catch((error) => {
          this.server_response = error._body;
        });

      //this.router.navigateByUrl('/readings/add')
      //}

    }
  }
loginDoctor() {
    this.submitted=true;
    if (this.loginptForm.dirty && this.loginptForm.valid) {
      //if (this.loginptForm.value.username == 'doctor' && this.loginptForm.value.password == 'doctor') {
        var contact = {
          username: this.loginptForm.value.username,
          password: this.loginptForm.value.password
        };
        this.loading = true;
        this.angularHttp.post("doctorLogin.json", contact)
        .toPromise()
        .then((response) => {
          this.server_response = JSON.stringify(response.json());
          var data = JSON.parse(this.server_response);
          console.log(response.json());
          //console.log(data.status);
          if (data.status == 200) {
            this.loading = false;
            localStorage.setItem('isLoggedIn', "true");
            localStorage.setItem('token',data.data["doctorinfo"]['app_token'] );
            localStorage.setItem('dr_id',data.data["doctorinfo"]['id'] );
            localStorage.setItem('profile_pic',data.data["doctorinfo"]['profile_pic'] );
            localStorage.setItem('designation',data.data["doctorinfo"]['designation'] );
            localStorage.setItem('name',data.data["doctorinfo"]['first_name']+' '+data.data["doctorinfo"]['last_name'] );
            
            this.router.navigateByUrl('profile')
          } else {

            this.theHtmlString = data.message;
            this.loading = false;
            //alert(data.message);

          }


        })
        .catch((error) => {
          this.server_response = error._body;
        });
      }
      else{
        return;
      }
   // }

  }


  ngOnInit() {

    var tim= new Date().toString();
    localStorage.setItem('TimeZone',tim);
   
    
  }
  //   createContact(){
  // alert('sas');
  // alert(`Username: ${this.loginptForm.value.username} password: ${this.loginptForm.value.password}`);

  //     var  contact  = {
  //         account:  1,
  //         address:  "Home N 333 Apartment 300",
  //         createdBy:  1,
  //         description:  "This is the third contact",
  //         email:  "abbess@email.com",
  //         first_name:  "kaya",
  //         isActive: true,
  //         last_name: "Abbes",
  //         phone: "00121212101"
  //     };
  //     this.apiService.createContact(contact).subscribe((response) => {
  //         console.log(response);
  //     });
  //     };



  //}
}
