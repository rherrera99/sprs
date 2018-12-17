import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DrforgotComponent } from './drforgot.component';

describe('DrforgotComponent', () => {
  let component: DrforgotComponent;
  let fixture: ComponentFixture<DrforgotComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DrforgotComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DrforgotComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
