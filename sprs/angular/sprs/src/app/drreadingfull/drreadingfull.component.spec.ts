import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DrreadingfullComponent } from './drreadingfull.component';

describe('DrreadingfullComponent', () => {
  let component: DrreadingfullComponent;
  let fixture: ComponentFixture<DrreadingfullComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DrreadingfullComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DrreadingfullComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
