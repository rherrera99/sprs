import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';

@Component({
  selector: 'app-addrating',
  templateUrl: './addrating.component.html',
  styleUrls: ['./addrating.component.css']
})
export class AddratingComponent implements OnInit {

  addRatingForm: any;
  constructor(private formBuilder: FormBuilder) {

    this.addRatingForm = this.formBuilder.group({
      'txt_date': ['', Validators.required],
      'txt_timeto': ['', [Validators.required]],
      'txt_timefrom': ['', [Validators.required]],
      'txt_weight': ['', [Validators.required]],
      'txt_height': ['', [Validators.required]],
      'txt_sugar': ['', [Validators.required]],
      'txt_bloodpresure': ['', [Validators.required]],
      //'profile': ['', [Validators.required, Validators.minLength(10)]]
    });
  }


  addRating() {
  
    if (this.addRatingForm.dirty && this.addRatingForm.valid) {
      
    }
  }
  ngOnInit() {
  }

}
