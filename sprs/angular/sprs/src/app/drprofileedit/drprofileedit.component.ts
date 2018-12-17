import { Component, OnInit } from '@angular/core';
import { AngularHttpProvider } from '../angular-http';
import { User } from '../_models';
import { FormBuilder, Validators } from '@angular/forms';
import { Router } from "@angular/router";
import { FileUploader, FileSelectDirective } from 'ng2-file-upload/ng2-file-upload';

@Component({
  selector: 'app-drprofileedit',
  templateUrl: './drprofileedit.component.html',
  styleUrls: ['./drprofileedit.component.css']
})
export class DrprofileeditComponent implements OnInit {

  currentUser: User;
  theHtmlString : string
  editdrForm: any;
  server_response :string;
  public loading = false;
  submitted = false;
  constructor(private formBuilder: FormBuilder, private router: Router, private angularHttp: AngularHttpProvider) { 

    this.editdrForm = this.formBuilder.group({
      'first_name': ['', [Validators.required]],
      'last_name': ['', [Validators.required]],
      'email': ['', [Validators.required,Validators.email]],
      'designation': ['', [Validators.required]],
      'contact_no': ['', [Validators.required]],
      'address': ['', [Validators.required]],

      'education': ['', [Validators.required]],
      'about': ['', [Validators.required]],
      'profile_pic': [''],
      'gender': ['']

  
      
      //'profile': ['', [Validators.required, Validators.minLength(10)]]
    });


  }
  public uploader: FileUploader = new FileUploader({ url: this.angularHttp.API_URL + 'fileUploaddr.json', itemAlias: localStorage.getItem('dr_id') });
  ngOnInit() {

    this.uploader.onAfterAddingFile = (file) => { file.withCredentials = false; };
    this.uploader.onCompleteItem = (item: any, response: any, status: any, headers: any) => {
      //console.log('ImageUpload:uploaded:', item, status, response);
      //alert('File uploaded successfully');
      var data = JSON.parse(response);
      if(data.status==200){
        localStorage.setItem('profile_pic',data.data['img']);
      }
      this.loading = false;
      this.router.navigateByUrl('/profile');;
    };
    this.getdrProfile();

  }
  get f() { return this.editdrForm.controls; }
editdr(){
  this.submitted=true;
  if (this.editdrForm.valid) { 
  var data = {
    dr_id : localStorage.getItem('dr_id'),
    first_name: this.editdrForm.value.first_name,
    last_name: this.editdrForm.value.last_name,
    email : this.editdrForm.value.email,
    designation : this.editdrForm.value.designation,
    contact_no : this.editdrForm.value.contact_no,
    address :this.editdrForm.value.address,
    education : this.editdrForm.value.education,
    about : this.editdrForm.value.about,
    gender : this.editdrForm.value.gender,
    
   

  };

  this.loading = true;
    this.angularHttp.post("editdrProfile.json", data)
      .toPromise()
      .then((response) => {
        this.server_response = JSON.stringify(response.json());
        var data = JSON.parse(this.server_response);

        if (data.status == 200) {
          //this.currentUser = data.data['patientinfo'][0];myprofile
          
          if (this.uploader.getNotUploadedItems().length) {
            this.uploader.uploadAll();
          } else {

            this.loading = false;
            this.router.navigateByUrl('/profile');;
          }
         // console.log(data);
          this.loading = false;
        }


      })
      .catch((error) => {
        this.server_response = error._body;
        this.loading = false;
      });

    }

}

  getdrProfile() {
    this.loading = true;
    var sendData = {'dr_id':localStorage.getItem('dr_id')}
    this.angularHttp.post("drDetails.json", sendData)
      .toPromise()
      .then((response) => {
        this.server_response = JSON.stringify(response.json());
        var data = JSON.parse(this.server_response);

        if (data.status == 200) {
          this.currentUser = data.data['drinfo'][0];
         // console.log(this.currentUser);
          this.loading = false;
        }


      })
      .catch((error) => {
        this.server_response = error._body;
        this.loading = false;
      });

  }

}
