import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Router } from "@angular/router";
import { APIService } from '../api.service';
import { AngularHttpProvider } from '../angular-http';
import { User } from '../_models';


@Component({
  selector: 'app-addpatient',
  templateUrl: './addpatient.component.html',
  styleUrls: ['./addpatient.component.css']
})
export class AddpatientComponent implements OnInit {

  public loading = false;
  addpatientForm: any;
  server_response: string;
  theHtmlString: string;
  theHtmlStringFormselect: string;
  formcheckArray : Array<any> = [];
  
  formlist: User[] = [];
  submitted = false;
  
  constructor(private formBuilder: FormBuilder, private router: Router,private apiService: APIService, private angularHttp: AngularHttpProvider) { 
    this.theHtmlString="";
    this.theHtmlStringFormselect='';
    this.addpatientForm = this.formBuilder.group({
      'fname': ['', [Validators.required]],
      'lname': ['', [Validators.required]],
      'pemail': ['', [Validators.required,Validators.email]],
      'pmobile': ['', [Validators.required]],
      'form_list': ['']
      //'profile': ['', [Validators.required, Validators.minLength(10)]]
    });
    

  }

  onChange(email:string, isChecked: boolean) {
    
    if(isChecked) {
      this.formcheckArray.push(email);
    } else {
      let index = this.formcheckArray.indexOf(email);
      this.formcheckArray.splice(index,1);
    }
}
get f() { return this.addpatientForm.controls; }

  addDoctorPatient(){
    this.submitted=true;
    if( this.formcheckArray.length > 0){
      this.theHtmlStringFormselect='';
    if (this.addpatientForm.dirty && this.addpatientForm.valid) {
      
     

        var contact = {
          dr_id : localStorage.getItem('dr_id'),
          first_name: this.addpatientForm.value.lname,
          last_name: this.addpatientForm.value.fname,
          email: this.addpatientForm.value.pemail,
          contact_no : this.addpatientForm.value.pmobile,
          form_list : this.formcheckArray,

        }; 
       
        this.loading = true;
        this.angularHttp.post("addDrPatient.json", contact)
        .toPromise()
        .then((response) => {
          this.server_response = JSON.stringify(response.json());
          var data = JSON.parse(this.server_response);
          
          if (data.status == 200) {        
          this.router.navigateByUrl('patients/list');
          this.loading = false;
          } else {

            this.theHtmlString = data.message;
            this.loading = false;
            

          }


        })
        .catch((error) => {
          this.server_response = error._body;
          this.loading = false;
        });

      }
      
      }else{ 

        this.theHtmlStringFormselect='At least one Form is required';
       }

  }
  getallFormlist(){
    this.loading = true;
    this.angularHttp.get("getallFromlist.json")
    .toPromise()
    .then((response) =>
    {
      this.server_response = JSON.stringify(response.json());
      var data = JSON.parse(this.server_response);
      if (data.status == 200) {

        this.formlist = data.data['form_list'];
       // console.log(this.formlist);
        this.loading = false;
      }
      //console.log(this.server_response);
    })
    .catch((error) =>
    {
      this.server_response = error._body;
      this.loading = false;
    });

  }
  ngOnInit() {
    //alert(this.router.url);
    this.getallFormlist();

  }


}
