/**
 * Name file: scroll-show
 * Description: this script adds an animation to the scrolling of the section
 *
 * @version: 1.2
 * @author: Enza Lombardo
 */

jQuery(document).ready(function () {

  // if section is Resumes
  if('#resumes'){
    const ScrollResume = document.querySelectorAll(".timeline");
  
    const elementInView = (el, dividend = 1) => {
      const elementTop = el.getBoundingClientRect().top;
  
      return(
        elementTop <=
        (window.innerHeight || document.documentElement.clientHeight) / dividend);
    };
  
    const elementOutofView = (el) => {
      const elementTop = el.getBoundingClientRect().top;
  
      return (
        elementTop > (window.innerHeight || document.documentElement.clientHeight)
      );
    };
  
    const displayScrollResume = (element) => {
      element.classList.add("scrolled");
    };
  
    const hideScrollResume = (element) => {
      element.classList.remove("scrolled");
    };
  
    const handleScrollAnimation = () => {
      ScrollResume.forEach((el) => {
        if(elementInView(el, 1.25)){
          displayScrollResume(el);
        } else if(elementOutofView(el)){
          hideScrollResume(el);
        }
      });
    };
  
    window.addEventListener("scroll", () =>{
      handleScrollAnimation();
    });
  }

  // if section is Skills
  if('#skills'){
    const ScrollSkill = document.querySelectorAll(".skill-group");

    const elementInView = (el, dividend = 1) => {
      const elementTop = el.getBoundingClientRect().top;

      return(
        elementTop <=
        (window.innerHeight || document.documentElement.clientHeight) / dividend);
    };

    const elementOutofView = (el) => {
      const elementTop = el.getBoundingClientRect().top;

      return (
        elementTop > (window.innerHeight || document.documentElement.clientHeight)
      );
    };

    const displayScrollSkill = (element) => {
      element.classList.add("scrolled");
    };

    const hideScrollSkill = (element) => {
      element.classList.remove("scrolled");
    };

    const handleScrollAnimation = () => {
      ScrollSkill.forEach((el) => {
        if(elementInView(el, 1.25)){
          displayScrollSkill(el);
        } else if(elementOutofView(el)){
          hideScrollSkill(el);
        }
      });
    };

    window.addEventListener("scroll", () =>{
      handleScrollAnimation();
    });
  }
});