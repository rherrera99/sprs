import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DrprofileeditComponent } from './drprofileedit.component';

describe('DrprofileeditComponent', () => {
  let component: DrprofileeditComponent;
  let fixture: ComponentFixture<DrprofileeditComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DrprofileeditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DrprofileeditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
