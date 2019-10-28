import java.util.ArrayList;
import java.util.Collections;

class MinPerimeterRectangle
{
    public int solution(int N) {
        ArrayList<Integer> factors = new ArrayList<Integer>();

        int sqrN = (int) Math.sqrt(N);
        if (Math.pow(sqrN, 2) != N) sqrN++;
        for (int i = 1; i < sqrN; i++) {
            if (N % i == 0) {
                factors.add(i);
                factors.add(N/i);
            }
        }
        if (Math.pow(sqrN, 2) == N) {
            factors.add(sqrN);
            factors.add(sqrN);
        }

        // Collections.sort(factors);
        Object[] aFactors = factors.toArray();
        int min = N + 1;
        int L = aFactors.length;
        for (int i = 0; i < L; i += 2) {
            int tMin = (int) aFactors[i] + (int) aFactors[i+1];
            System.out.println((int) aFactors[i] + " --- " + (int) aFactors[i+1]);
            if (tMin < min) min = tMin;
        }

        return min * 2;
    }

    public static void main(String[] args) {
        MinPerimeterRectangle mr = new MinPerimeterRectangle();
        System.out.println(mr.solution(36));
    }
}