import closestFactor from "./getNearestFactorOfN.js";
import { sectionSelector } from "../config/builder.js";

export default (scrollTop, lineHeight) => {
    return (
        closestFactor(scrollTop - sectionSelector.verticalPadding, lineHeight) +
        sectionSelector.verticalPadding
    );
};
