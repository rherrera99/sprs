import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DrprofileComponent } from './drprofile.component';

describe('DrprofileComponent', () => {
  let component: DrprofileComponent;
  let fixture: ComponentFixture<DrprofileComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DrprofileComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DrprofileComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
